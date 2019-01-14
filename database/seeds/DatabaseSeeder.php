<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $carClass = $this->insertCarClass();
        $option = $this->insertOption();
        $this->insertUserGroups();
        $this->insertStages();
        $graph = $this->insertGraph();

        // добавляем тачку
        $car = new \App\Car();
        $car->car_class_id = $carClass->id;
        $car->geom = DB::raw('ST_GeomFromText(\'POINT(37.618423 55.751244)\', 4326)');
        $car->save();
        $car->options()->save($option); // добавляем опцию детское кресло

        $tariff = new \App\Tariff();
        $tariff->time_billing_max_cost = 2700;
        $tariff->graph_id = $graph->id;
        $tariff->save();

        DB::table('stage_tariff')->insert(
            [
                'stage_id' => 1,
                'tariff_id' => 1,
                'cost_per_minute' => 2,
                'free_period_since_hour' => 23,
                'free_period_till_hour' => 7,
                'free_minutes_at_start' => 40,
                'car_class_id' => 1,
                'user_group_id' => 1,
            ]
        );

        DB::table('stage_tariff')->insert(
            [
                'stage_id' => 2,
                'tariff_id' => 1,
                'cost_per_minute' => 2,
                'free_minutes_at_start' => 7,
                'car_class_id' => 1,
                'user_group_id' => 1,
            ]
        );

        DB::table('stage_tariff')->insert(
            [
                'stage_id' => 3,
                'tariff_id' => 1,
                'cost_per_minute' => 8,
                'cost_per_kilometer' => 10,
                'free_kilometers_per_day' => 70,
                'car_class_id' => 1,
                'user_group_id' => 1,
            ]
        );

        DB::table('stage_tariff')->insert(
            [
                'stage_id' => 4,
                'tariff_id' => 1,
                'cost_per_minute' => 2,
                'free_period_since_hour' => 23,
                'free_period_till_hour' => 7,
                'car_class_id' => 1,
                'user_group_id' => 1,
            ]
        );
    }

    private function insertCarClass(): \App\CarClass
    {
        $carClass = new \App\CarClass();
        $carClass->name = 'Эконом';
        $carClass->save();

        return $carClass;
    }

    private function insertUserGroups(): void
    {
        $userGroup = new \App\UserGroup();
        $userGroup->name = 'Студенты';
        $userGroup->save();
    }

    private function insertStages(): void
    {
        $stageNames = ['Бронирование', 'Осмотр', 'Поездка', 'Парковка', 'Завершено', 'Отмена'];
        foreach ($stageNames as $stageName) {
            $stage = new \App\Stage();
            $stage->name = $stageName;
            $stage->save();
        }
    }

    private function insertOption(): \App\Option
    {
        $option = new \App\Option();
        $option->name = 'Детское кресло';
        $option->cost_per_minute = 2;
        $option->time_billing_max_add = 300;
        $option->save();

        return $option;
    }

    private function insertGraph(): \App\Graph
    {
        $graph = new \App\Graph();
        $graph->save();

        $this->insertNodes($graph);
        $this->insertEdges($graph);

        return $graph;
    }

    /**
     * @param $graph
     */
    private function insertNodes($graph): void
    {
        $node = new \App\Node();
        $node->stage_id = 1;
        $node->type = 'initial';
        $graph->nodes()->save($node);

        foreach (range(2, 4) as $stage_id) {
            $node = new \App\Node();
            $node->stage_id = $stage_id;
            $node->type = 'intermediate';
            $graph->nodes()->save($node);
        }

        $node = new \App\Node();
        $node->stage_id = 5;
        $node->type = 'final';
        $graph->nodes()->save($node);

        $node = new \App\Node();
        $node->stage_id = 6;
        $node->type = 'final';
        $graph->nodes()->save($node);
    }

    /**
     * @param $graph
     */
    private function insertEdges(\App\Graph $graph): void
    {
        // бронь - осмотр
        $edge = new \App\Edge();
        $edge->source_node_id = 1;
        $edge->target_node_id = 2;
        $graph->edges()->save($edge);

        // бронь - отмена
        $edge = new \App\Edge();
        $edge->source_node_id = 1;
        $edge->target_node_id = 6;
        $graph->edges()->save($edge);

        // осмотр - езда
        $edge = new \App\Edge();
        $edge->source_node_id = 2;
        $edge->target_node_id = 3;
        $graph->edges()->save($edge);

        // осмотр - отмена
        $edge = new \App\Edge();
        $edge->source_node_id = 2;
        $edge->target_node_id = 6;
        $graph->edges()->save($edge);

        // езда - парковка
        $edge = new \App\Edge();
        $edge->source_node_id = 3;
        $edge->target_node_id = 4;
        $graph->edges()->save($edge);

        // езда - завершено
        $edge = new \App\Edge();
        $edge->source_node_id = 3;
        $edge->target_node_id = 5;
        $graph->edges()->save($edge);

        // парковка - езда
        $edge = new \App\Edge();
        $edge->source_node_id = 4;
        $edge->target_node_id = 3;
        $graph->edges()->save($edge);

        // парковка - завершено
        $edge = new \App\Edge();
        $edge->source_node_id = 4;
        $edge->target_node_id = 5;
        $graph->edges()->save($edge);
    }
}

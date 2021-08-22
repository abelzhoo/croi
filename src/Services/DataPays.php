<?php 

namespace App\Services;

class DataPays {

    private $regions = [
        'Antananarivo' => '|Itasy|Analamanga|Vakinankaratra|Bongolava',
        'Fianarantsoa' => '|Amoron\'i Mania|Haute Matsiatra|Vatovavy-Fitovinany|Atsimo-Atsinanana|Ihoromb',
        'Toamasina'    => '|Alaotra-Mangoro|Atsinanana|Analanjirofo',
        'Toliara'      => '|Menabe|Atsimo-Andrefana|Androy|Anôsy',
        'Mahajanga'    => '|Melaky|Betsiboka|Boeny|Sofia',
        'Antsiranana'  => '|Sava|Diana'
    ];

    private $provinces = [];
    private $getRegions = [];

    public function getProvince($pays){
        if($pays === "Madagascar"){
            foreach($this->regions as $key => $region){
                $this->province[] = $key;
            }
        }

        return $this->province;
    }

    public function getRegion($province){
        foreach($this->regions as $key => $region){
            if($this->provinces[$key] == $province){
                $formatData = explode('|', $region);
                $this->getRegions[] = $formatData;
            }
        }

        return $this->getRegions;
    }
}
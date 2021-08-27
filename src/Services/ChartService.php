<?php 

namespace App\Services;

class ChartService {

    public function chart($datasCas, $datasPers): array
    {
        foreach($datasCas as $data){
            $tabDatas[] = $data->getAnnee();    
        }
        $datasLabels =  isset($tabDatas) ? $tabDatas : [];
        sort($datasLabels);
        $getValues = array_count_values($datasLabels);

        if(isset($getValues) && $getValues != null){
            $nombreGlobal = count($datasPers);
            $nombreWith = count($datasCas);
            $nombreWithout = $nombreGlobal - $nombreWith;
            foreach($getValues as $getVal){
                $calculeWiht['calculeWithout'][] = ((($nombreWith - $getVal) + $nombreWithout) * 100) / $nombreGlobal;
                $calculeWiht['calculeWiht'][] = ($getVal * 100) / $nombreGlobal;
            }
            $calculeWiht['labels'] = array_unique($datasLabels);
        }else{
            $calculeWiht['labels'] = [];
            $calculeWiht['calculeWithout'] = [];
            $calculeWiht['calculeWiht'] = [];
        }
        
        return $calculeWiht ; 
    }

    public function chartLogement($datasCas, $datasPers){
        foreach($datasCas as $data){
            $dataLabels[] = $data->getAnnee();            
            if($data->getProprietaire() == true){
                $getProprs[] = array_count_values($dataLabels);
                break;
            }else{
                $getLocs[] = array_count_values($dataLabels);  
            }
        }
        $labelsBlobs =  isset($dataLabels) ? $dataLabels : [];
        sort($labelsBlobs);
        $nombreGlobal = count($datasPers);
        $nombreWith = count($datasCas);
        $nombreWithout = $nombreGlobal - $nombreWith;

        if(isset($getProprs) && isset($getLocs) && $getProprs != null && $getLocs != null){
            foreach($getProprs as $getPropr){
                foreach($getPropr as $p){
                   $dataProps['proprietaire'][] = ($p * 100) / $nombreGlobal;
                }
            }
            foreach($getLocs as $getLoc){
                foreach($getLoc as $l){
                   $dataProps['locataire'][] = ((($nombreWith - $l) + $nombreWithout) * 100) / $nombreGlobal;
                }
            }
            $dataProps['labels'] = array_unique($labelsBlobs);
        }else{
            $dataProps['labels'] = [];
            $dataProps['proprietaire'] = [];
            $dataProps['locataire'] = [];
        }
        
        return $dataProps;   
    }
    
}
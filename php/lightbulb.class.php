<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lightbulbs
 *
 * @author Brody
 */
class Lightbulb extends Appliance{
    protected $name;
    protected $lightID;
    
    public function __construct($id = null) {
        parent::__construct($id);
        if(isset($this->description)){
            $details = explode(",", $this->description);
            $this->name = $details[0];
            $this->lightID = $details[1];
        }
    }
    
    public function load_by_id($id) {
        parent::load_by_id($id);
        $details = explode(",", $this->description);
        $this->name = $details[0];
        $this->lightID = $details[1];
    }
    
    public function toggle(){
        
    }
    
    public function turnOff(){
        $this->status = 0;
        $this->save();
    }
    
    public function turnOn(){
        $this->status = 1;
        $this->save();
    }
    
    public function isOn(){
        return ($this->status === '1');
    }
    
    public function activateLight(){
        if($this->isOn()){
            //causes slowdown
            $command = escapeshellcmd("python /var/www/python/LightsHandler.py $this->applianceId on");
        shell_exec($command);
        }        
    }
    
    /**
     * gets lightbulb form
     * @return string HTML div
     */
    public static function getLightBulbForm(){
        //get all lightbulbs from db and create button for each
        $lightArray = self::get_appliances_by_type('light');
        $form = "<div><h2>Lights</h2>";
        foreach($lightArray as $lightID){
            $light = new Lightbulb();
            $light->load_by_id($lightID['applianceId']);
            $button = $light->getButtonDiv();
            $form .= "<div>$button</div>";
            $light->activateLight();
        }
        $party = "<button onclick='commenceParty(); '>Party Button</button>";
        $form .= "$party</div>";
        return $form;
    }
    
    /**
     * 
     * @return string HTML Div of button and label
     */
    private function getButtonDiv(){    
        //add image based on status
        $source = "../images/light_bulb_on.png";
        $off_source = "../images/light_bulb_off.png";
        $onclick = "toggleLight(this, '$this->applianceId', $this->status, '$this->description'); ";
        $on_style = 'display:block;';
        $off_style = 'display:block;';
        
        if($this->status === '1'){
            $off_style = 'display:none;';
            $status = "off";
        }else{
            $on_style = 'display:none;';
            $status = "on";
        }
        $on_image = "<img src='$source' height = '100' width='100' id='lightbulb_on_$this->applianceId' style='$on_style'>";
        $off_image = "<img src='$off_source' height = '100' width='100' id='lightbulb_off_$this->applianceId' style='$off_style'>";
        
        $button = "<div class='lightbulb' onclick = \"$onclick\" data-id=$this->applianceId data-status='$status'>$this->name $on_image $off_image</div>";
        return $button;
    }
}

<?php

namespace WsDeathMessage;

use pocketmine\event\Listener;
use pocketmine\plugin\{PluginBase,Plugin};
use pocketmine\{Player,Server};
use pocketmine\utils\Config;
use pocketmine\event\{player\PlayerDeathEvent,entity\EntityDamageByEntityEvent};


class DeathMessage extends PluginBase implements Listener{

public function onEnable(){
		$this->getLogger()->info("§a自定义击杀提示 by Wshape1");
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		
		@mkdir($this->getDataFolder(),0777,true);
		$this->Msg=new Config($this->getDataFolder()."Msg.yml",Config::YAML,[
		"DeathMessage"=>"§c天啦噜, §e{杀人} §b竟然杀死了§e {死人} §c,快报警啊!!!"
		]);
		
	}
	
	
	public function Killed(PlayerDeathEvent $event){

	$ldamage=$event->getEntity()->getLastDamageCause();
   
			if($ldamage instanceof EntityDamageByEntityEvent){
	$dmsg=str_replace("{杀人}",$ldamage->getDamager()->getPlayer()->getName(),$this->Msg->get("DeathMessage"));
	$dmsg=str_replace("{死人}",$event->getPlayer()->getName(),$dmsg);
	$event->setDeathMessage($dmsg);
	
	}
	}
	
	
	}
	
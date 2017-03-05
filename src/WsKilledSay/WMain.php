<?php

namespace WsKilledSay;

use pocketmine\plugin\Plugin;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\utils\Config;


use pocketmine\event\player\PlayerDeathEvent;

use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;


class WMain extends PluginBase implements Listener{

public function onEnable(){
		$this->getLogger()->info("§a自定义击杀提示 by Wshape1");
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		
		@mkdir($this->getDataFolder(),0777,true);
		$this->Msg=new Config($this->getDataFolder()."Msg.yml",Config::YAML,[
		"DeathMessage"=>"§c天啦噜, §e{Killer} §b竟然杀死了§e {Dead} §c,快报警啊!!!",
		]);
		
	}
	
	public function EntityDamageEvent(EntityDamageEvent $event){
	if($event instanceof EntityDamageByEntityEvent){
	$this->damager=$event->getDamager()->getName();
	}
	}
	
	
	public function Killed(PlayerDeathEvent $event){
	$dead=$event->getPlayer()->getName();
	$dmsg=$this->Msg->get("DeathMessage");
	$dmsg=str_replace("{Killer}",$this->damager,$dmsg);
	$dmsg=str_replace("{Dead}",$dead,$dmsg);
	$event->setDeathMessage($dmsg);
	
	}
	
	
	
	}
	
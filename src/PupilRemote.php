<?php
namespace Ignacioxd;

use \ZMQ;
use \ZMQSocket;
use \ZMQContext;

class PupilRemote {
  private $socket = null;
  private $isConnected = false;

  public function __construct() {
    if(!class_exists('ZMQSocket')) {
       throw new \Exception("The ZeroMQ extension must be installed");
    }
  }

  public function connect($host = "127.0.0.1", $port = 50020, $socketName = "PHPZMQSocket") {
    $this->socket = new ZMQSocket(new ZMQContext(), ZMQ::SOCKET_REQ, $socketName);
    $dsn = "tcp://$host:$port";
    $this->socket->connect($dsn);
    $this->isConnected = true;
  }

  public function getTimebase() {
    if(!$this->isConnected) {
       throw new \Exception("Socket not connected");
    }
    $time = $this->socket->send("t")->recv();
    return $time;
  }

  public function setTimebase(float $base) {
    if(!$this->isConnected) {
       throw new \Exception("Socket not connected");
    }
    $this->socket->send("T {$base}")->recv();
  }

  public function startCalibration() {
    if(!$this->isConnected) {
       throw new \Exception("Socket not connected");
    }
    $result = $this->socket->send("C")->recv();
    return $result === "OK";
  }

  public function stopCalibration() {
    if(!$this->isConnected) {
       throw new \Exception("Socket not connected");
    }
    $result = $this->socket->send("c")->recv();
    return $result === "OK";
  }

  public function startRecording($recordingName = null) {
    if(!$this->isConnected) {
       throw new \Exception("Socket not connected");
    }
    $result = $this->socket->send("R" . ($recordingName !== null ? " {$recordingName}" : ""))->recv();
    return $result === "OK";
  }

  public function stopRecording() {
    if(!$this->isConnected) {
       throw new \Exception("Socket not connected");
    }
    $result = $this->socket->send("r")->recv();
    return $result === "OK";
  }

}

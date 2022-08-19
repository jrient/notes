<?php

interface OutputInterface
{
    public function load($arrayOfData);
}

class SerializedArrayOutput implements OutputInterface
{
    public function load($arrayOfData)
    {
        return serialize($arrayOfData);
    }
}

class JsonStringOutput implements OutputInterface
{
    public function load($arrayOfData)
    {
        return json_encode($arrayOfData);
    }
}

class ArrayOutput implements OutputInterface
{
    public function load($arrayOfData)
    {
        return $arrayOfData;
    }
}

class SomeClient
{
    private $output;

    public function setOutput(OutputInterface $outputType)
    {
        $this->output = $outputType;
    }

    public function loadOutput($arrayOfData)
    {
        return $this->output->load($arrayOfData);
    }
}

$client = new SomeClient();

// Want an array?
$client->setOutput(new ArrayOutput());
$data = $client->loadOutput([1,2,3]);
var_dump($data);

// Want some JSON?
$client->setOutput(new JsonStringOutput());
$data = $client->loadOutput([4,5,6]);
var_dump($data);
<?php

use PHPMake\SerialPort as SerialPort;

function serialPortDump(SerialPort $sp) {
    printf(
            'flow control: %s' . PHP_EOL .
            'baud rate: %d' . PHP_EOL .
            'canonical: %s' . PHP_EOL .
            'char size: %d' . PHP_EOL .
            'stop bits: %d' . PHP_EOL .
            'parity: %s' . PHP_EOL .
            'vmin: %d' . PHP_EOL .
            'vtime: %d' . PHP_EOL .
            'CTS: %s' . PHP_EOL .
            'RTS: %s' . PHP_EOL .
            'DSR: %s' . PHP_EOL .
            'DTR: %s' . PHP_EOL .
            'DCD: %s' . PHP_EOL .
            'RNG: %s' . PHP_EOL .
            PHP_EOL, 
            $sp->getFlowControl(),
            $sp->getBaudRate(),
            $sp->isCanonical() ? 'true' : 'false',
            $sp->getCharSize(),
            $sp->getNumOfStopBits(),
            $sp->getParity(),
            $sp->getVMin(),
            $sp->getVTime(),
            $sp->getCTS() ? 'true' : 'false',
            $sp->getRTS() ? 'true' : 'false',
            $sp->getDSR() ? 'true' : 'false',
            $sp->getDTR() ? 'true' : 'false',
            $sp->getDCD() ? 'true' : 'false',
            $sp->getRNG() ? 'true' : 'false');
}

if ($argc < 2) {
    die ('Usage: php ' . basename(__FILE__) . ' /path/to/devfile' . PHP_EOL);
}

$sp = new SerialPort($argv[1]);

serialPortDump($sp);

$sp->setFlowControl(SerialPort::FLOW_CONTROL_HARD)
        ->setBaudRate(SerialPort::BAUD_RATE_38400)
        ->setCanonical(!$sp->isCanonical())
        ->setCharSize(SerialPort::CHAR_SIZE_8)
        ->setNumOfStopBits(SerialPort::STOP_BITS_2_0)
        ->setVMin(1)
        ->setVTime(0)
        ->setParity(SerialPort::PARITY_NONE);

serialPortDump($sp);

$sp->close();

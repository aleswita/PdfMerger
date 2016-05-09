<?php

/**
 * This file is part of the AlesWita\PdfMerger
 * Copyright (c) 2016 Ales Wita (aleswita@gmail.com)
 */

namespace AlesWita;

use Nette;


/**
 * @author Aleš Wita
 */
class PdfMergerExtension extends Nette\DI\CompilerExtension
{
	/** @var array */
	public $defaults = [
		"program" => PdfMerger::PROGRAM,
		"params" => PdfMerger::PARAMS,
		"outputFileName" => PdfMerger::OUTPUT_FILE_NAME,
	];

	public function loadConfiguration()
	{
		$config = $this->getConfig($this->defaults);
		$container = $this->getContainerBuilder();

		$pdfMerger = $container->addDefinition($this->prefix("pdfmerger"))
			->setClass("AlesWita\PdfMerger");

		if ($config["program"] !== PdfMerger::PROGRAM) {
			$pdfMerger->addSetup('$service->setProgram(?)', [$config["program"]]);
		}
		if ($config["params"] !== PdfMerger::PARAMS) {
			$pdfMerger->addSetup('$service->setParams(?)', [$config["params"]]);
		}
		if ($config["outputFileName"] !== PdfMerger::OUTPUT_FILE_NAME) {
			$pdfMerger->addSetup('$service->setOutputFileName(?)', [$config["outputFileName"]]);
		}
	}
}

<?php

/**
 * This file is part of the AlesWita\PdfMerger
 * Copyright (c) 2016 Ales Wita (aleswita@gmail.com)
 */

declare(strict_types=1);

namespace AlesWita;

use Nette;


/**
 * @author Aleš Wita
 */
final class PdfMergerExtension extends Nette\DI\CompilerExtension
{
	/** @var array */
	public $defaults = [
		"program" => PdfMerger::PROGRAM,
		"params" => PdfMerger::PARAMS,
		"outputFile" => PdfMerger::OUTPUT_FILE,
	];

	/**
	 * @return void
	 */
	public function loadConfiguration(): void {
		$config = $this->getConfig($this->defaults);
		$container = $this->getContainerBuilder();

		$pdfMerger = $container->addDefinition($this->prefix("pdfmerger"))
			->setClass("AlesWita\\PdfMerger");

		if ($config["program"] !== PdfMerger::PROGRAM) {
			$pdfMerger->addSetup('$service->setProgram(?)', [$config["program"]]);
		}
		if ($config["params"] !== PdfMerger::PARAMS) {
			$pdfMerger->addSetup('$service->setParams(?)', [$config["params"]]);
		}
		if ($config["outputFile"] !== PdfMerger::OUTPUT_FILE) {
			$pdfMerger->addSetup('$service->setOutputFile(?)', [$config["outputFile"]]);
		}
	}
}

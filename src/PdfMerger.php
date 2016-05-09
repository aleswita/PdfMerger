<?php

/**
 * This file is part of the AlesWita\PdfMerger
 * Copyright (c) 2016 Ales Wita (aleswita@gmail.com)
 */

namespace AlesWita;


/**
 * @author Aleš Wita
 */
class PdfMerger
{
	const PROGRAM = "gs";
	const PARAMS = [
		"-q",
		"-dNOPAUSE",
		"-dBATCH",
		"-sDEVICE=pdfwrite",
	];
	const OUTPUT_FILE_NAME = "NewPdf.pdf";

	/** @var string */
	private $program = self::PROGRAM;

	/** @var string */
	private $params = self::PARAMS;

	/** @var string */
	private $outputFileName = self::OUTPUT_FILE_NAME;

	/** @var string */
	private $command;

	/** @var array */
	private $files = [];

	/**
	 * @param string
	 * @return self
	 * @throws AlesWita\FileNotFound
	 */
	public function addPdf(string $file): self {
		if (file_exists($file)) {
			$this->files[] = $file;
		} else {
			throw new FileNotFound($file);
		}
		return $this;
	}

	/**
	 * @param string
	 * @return self
	 */
	public function addParam(string $param): self {
		$this->params[] = $param;
		return $this;
	}

	/**
	 * @param string
	 * @return self
	 */
	public function setProgram(string $program): self {
		$this->program = $program;
		return $this;
	}

	/**
	 * @param array
	 * @return self
	 */
	public function setParams(array $params): self {
		$this->params = $params;
		return $this;
	}

	/**
	 * @param string
	 * @return self
	 */
	public function setOutputFileName(string $fileName): self {
		$this->outputFileName = $fileName;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getProgram(): string {
		return $this->program;
	}

	/**
	 * @return string
	 */
	public function getParams(): string {
		return $this->params;
	}

	/**
	 * @return string
	 */
	public function getOutputFileName(): string {
		return $this->outputFileName;
	}

	/**
	 * @return string
	 */
	public function getCommand(): string {
		return $this->program . " " . implode(" ", $this->params) . $this->outputFileName . " " . implode(" ", $this->files);
	}

	public function merge()
	{
		$this->params[] = "-sOutputFile=";

		shell_exec($this->getCommand());
		$this->files = [];
	}
}

class FileNotFound extends \Exception
{
}

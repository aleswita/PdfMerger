# PdfMerger
PdfMerger for Nette Framework and Ghost Script.

## Installation
The best way to install AlesWita/PdfMerger is using [Composer](http://getcomposer.org/):
```sh
$ composer require aleswita/pdfmerger:dev-master
```

## Usage

### Configuration
```neon
extensions:
  pdfmerger: AlesWita\PdfMergerExtension
	
pdfmerger:
  program: "\"C:\\Program Files\\gs\\gs9.19\\bin\\gswin64c.exe\""
```

### Presenter
```php
use AlesWita;

final class HomePresenter extends BasePresenter
{
  /** @var AlesWita\PdfMerger @inject */
  public $pdfMerger;

  ...
  
  public function handleMergePdf(array $files): void {
    foreach ($files as $file) {
      $this->pdfMerger->addPdf($file);
    }
  
    $this->pdfMerger->setOutputFile("test.pdf")
      ->merge();
  }
}
```

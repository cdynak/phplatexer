<?php
class PHPLatexer
{
  private $document = '';
  private $document_name = 'document';
  private $default_header = '
\documentclass{article}
\usepackage{graphicx}
\usepackage{polski}
\usepackage[utf8]{inputenc}
\usepackage{geometry}
\geometry{ a4paper, total={210mm,297mm}, left=10mm, right=10mm, top=10mm, bottom=10mm }
\pagenumbering{gobble}
';
  private $document_begin = '
\begin{document}
';
  private $document_end = '
\end{document}
';
  public function setDocumentName($doc_name)
  {
    $this->document_name = $doc_name;
  }
  public function addHeader()
  {
    $this->document .= $this->default_header;
  }
  public function beginDocument()
  {
    $this->document .= $this->document_begin;
  }
  public function endDocument()
  {
    $this->document .= $this->document_end;
  }
  public function addGraphics($path,$caption)
  {
    $this->document .= '
\begin{figure}
  \centering
  \includegraphics{'.$path.'}
  \caption{'.$caption.'}
\end{figure}
';
  }
  public function addVerbatim($text)
  {
    $this->document .= '
\begin{verbatim}
'.$text.'
\end{verbatim}
';
  }
  public function addCustom($text)                                              
  {                                                                             
    $this->document .= '                                                        
'.$text.'                                                                       
';                                                                              
  }                                                                             
  public function put()
  {
    file_put_contents($this->document_name.'.tex',$this->document);
  }
  public function compile()
  {
    exec('pdflatex '.$this->document_name.'.tex');
  }
  public function make()
  {
    $this->put();
    $this->compile();
  }
}

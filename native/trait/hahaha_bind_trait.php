<?php

namespace hahahalib;

/*
尚未實作

慎用，如要客製化function，可以繼承出來直接寫function功能，這也是一種方法

這種方式盡量不要用在主流程模組內使用，用途規劃在第二段模組(非主流程使用的模組外，主流程使用模組強調精簡)
規劃者可以決定要不要摻這種屬性，但是出事請他負責

這種屬性，維護架構者不應該直接建置在主要架構上(因為在web架構強調快，所以主流程使用模組必須最簡化，大概意思是要是有10幾種trait都加入，會使的模組肥大)
例如我有lite & normal的server讀取資訊模組，因為lite用在主流程，所以如要使用bind則不宜加在lite，比較好是加在normal，或者custom一個你想要的模組(其實如果這樣，如上面所說，為什麼bind不直接寫成function加在新建的class內)
因為這架構是hahaha規劃，所以，在hahaha沒修改規劃前，bind這種附加功能，禁止協同打架構者直接加在主流程使用模組(因為hahaha要最精簡)，如要加，則使用框架規劃專案的負責人決定，但是出事請他負責

其實要bind，我有規劃menu，可以使用，其實可以將bind的東西建一個menu，要用時再建立

實作方法，寫__call查array對應callback呼叫對應
*/
trait hahaha_bind_trait
{

}

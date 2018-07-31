$(document).ready(function() {
   var span = 1;
   var prevTD = "";
   var prevTDVal = ""; 
   $("#optional tr th:first-child").each(function() { 
      var $this = $(this);
      if ($this.text() == prevTDVal) { // 現在のtdの価値と前のtdの価値を比較
         span++;
         if (prevTD != "") {
            prevTD.attr("rowspan", span); // 以前のtdに属性を追加する
            $this.remove(); // //現在のtdを削除
         }
      } else {
         prevTD     = $this; //   現在のtdを保存する
		 prevTDVal  = $this.text();
         span       = 1;
      }
   });
});
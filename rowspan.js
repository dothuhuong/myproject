$(document).ready(function() {
   var span = 1;
   var prevTD = "";
   var prevTDVal = ""; 
   $("#optional tr th:first-child").each(function() { 
      var $this = $(this);
      if ($this.text() == prevTDVal) { // ���݂�td�̉��l�ƑO��td�̉��l���r
         span++;
         if (prevTD != "") {
            prevTD.attr("rowspan", span); // �ȑO��td�ɑ�����ǉ�����
            $this.remove(); // //���݂�td���폜
         }
      } else {
         prevTD     = $this; //   ���݂�td��ۑ�����
		 prevTDVal  = $this.text();
         span       = 1;
      }
   });
});
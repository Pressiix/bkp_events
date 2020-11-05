<footer>
	<div class="sectionProfile">
		<div class="container">
      <div class="row">
        <div class="col-12">
          <div class="company-detail">
            <div class="logo-post">
              <a href="javascript:void(0);"><img src="<?= $_STATIC_URL ?>assets/images/logo/postgroup-logo_white.svg"></a>
            </div>
            <span>
              <p style="animation: none; margin: 0; padding: 0 0 0 0px; font-size: 0.875rem; font-family: Thonburi,Tahoma,Arial; font-weight: normal;">
                &copy; 1996 - 2019 Bangkok Post Public Company Limited 
                <span class="truehits" id="truehits_div">
                            <script type="text/javascript">
                                __th_page = "<?= $this->event['truehits'] ?>"
                            </script>
                            <script type="text/javascript">
                                (function() {
                                var ga1 = document.createElement('script');
                                ga1.type = 'text/javascript';
                                ga1.async = true;
                                ga1.src = "//lvs.truehits.in.th/dataa/s0028944.js?v=2";
                                var s = document.getElementsByTagName('script')[0];
                                s.parentNode.insertBefore(ga1, s);
                                })();
                            </script>
                        </span>
              </p>
        </span> 
          </div>
        </div>
      </div>
    </div>
	</div>
</footer>

<script>

  function GoToContent(id)
  {
    window.location.href = '#'+id;
    window.history.pushState('#'+id, 'Title', '<?= $_URL ?>');
  }

    $.validator.addMethod('customphone', function (value, element) {
			return this.optional(element) || /^\d{9,10}$/.test(value);
		}, "Please enter a valid phone number");
		$.validator.addClassRules('customphone', {
			customphone: true
		});
    $.validator.addMethod('custom_mail', function (value, element) {
			return this.optional(element) || /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(value);
		}, "Please enter a valid email");
		$.validator.addClassRules('custom_mail', {
			custom_mail: true
		});

  $(document).ready(function() {
    $('input').keyup(function()
    {
      if($(this).val())
      {
        $(this).css("border-color", "");
        $(this).css("background-color", "#e8f0fe");
        $(this).css("color", "black");
        if($(this).next().find( 'label[class*="error"]').length > 0 || $(this).next().find('label[class*="valid"]').length > 0)
        {
          $(this).parent().css('padding-bottom','25px');
          if(!$(this).next().find('label[class*="error"]').is(":hidden"))
          {
            $(this).css('border-color','red');
            console.log('A');
          }else{
            $(this).parent().css('padding-bottom','0px');
            console.log('B');
           }
        }else{
          $(this).parent().css('padding-bottom','0px');
        }
      }else{
        $(this).parent().css('padding-bottom','25px');
      }
      
    })

    $("#registerForm").validate({
          errorPlacement: function(error, element) {
              error.appendTo(element.next());
              element[0].parentNode.style.padding = "0 0 25px"; //parent div tag
              element[0].style.borderColor  = 'red'; //input tag
              element[0].style.backgroundColor  = '';//input tag
              element.next()[0].style.color = 'red';  //error message
              element.next()[0].style.fontWeight = 'bold'; //error message
          },
          rules: {
              name: "required",
              lastname: "required",
              company: "required", 
              position: "required",					
              email: {
                required: true,
                custom_mail: true,
              },
              
              phone: {
                required: true,
                customphone: true,
              },
              // option:"required",
          },
          messages: {
              name: "*Information required/โปรดกรอกข้อมูลให้ครบถ้วน",
              lastname: "*Information required/โปรดกรอกข้อมูลให้ครบถ้วน",
              company: "*Information required/โปรดกรอกข้อมูลให้ครบถ้วน",
              position: "*Information required/โปรดกรอกข้อมูลให้ครบถ้วน",
              email: {
                required: "*Information required/โปรดกรอกข้อมูลให้ครบถ้วน",
                custom_mail:"*Invalid data/ข้อมูลไม่ถูกต้อง",
              },
              phone: { 
                required:"*Information required/โปรดกรอกข้อมูลให้ครบถ้วน",
                customphone:"*Invalid data/ข้อมูลไม่ถูกต้อง",
              },
              // option:"*Information required/โปรดกรอกข้อมูลให้ครบถ้วน",
          }
    });
});
</script>
	
</body>
</html>

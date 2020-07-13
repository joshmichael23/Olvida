<script>
    function generate() {

        // document.getElementById("nochapter").value = 3;
        var a = parseInt(<?php echo $this->session->userdata('cat_no') ?>);
        //var a = parseInt();
        var ch = document.getElementById("ch");
        var dpd = document.getElementById("dpd");
        for (i = 0; i < a; i++) {
            var input = document.createElement("input");
            var select = document.createElement('select');
            var select2 = document.createElement('select');
            var br = document.createElement('br');
            
            var option1 = new Option('Individual', 'Individual', false, false);
            var option2 = new Option('Group', 'Group', false, false);

            var choose1 = new Option('Yes', 'Yes', false, false);
            var choose2 = new Option('No', 'No', false, false);

            select.appendChild(option1);
            select.appendChild(option2);

            select2.appendChild(choose1);
            select2.appendChild(choose2);
            // select.class='btn btn-default dropdown-toggle';
            // select.data-toggle='dropdown';
            // select.aria-expanded='false';


            var no = i +1;
            input.setAttribute("value", "Category " + no);
            input.setAttribute("id", "input_" + i);
            input.setAttribute("name", "input_" + i);
            input.style.marginRight="10px";

            //input.setAttribute("name", "input[i]");

            select.setAttribute("id", 'select_'+i);
            select.setAttribute("name", "select_" + i);
            select.style.marginRight="5px"; 

            select2.setAttribute("id", 'select2_'+i);
            select2.setAttribute("name", "select2_"+i);

            //select.setAttribute("name", 'select_'+i);

            ch.appendChild(input);

            ch.appendChild(select);
            ch.appendChild(select2);
            ch.appendChild(br);
            // br = <?php echo "<br"; ?>
            // ch.appendchild(br);
        }

        
        // alert($('#input_2').val());

        // alert($('input[name*="input"]').length);

    }    

    window.onload = generate;

</script>

<body>
   <br>


  <section id="main" role="main">
    <section class="container">

            
   <center>
        <div class="row">
          <div class="col-md-3">

          </div>

          <div style="align-content: " class="col-md-5">
              <!-- Horizontal Form -->
              <div class="box box-info">
                <div class="box-header with-border">
                              <div class="box-body">
                  <div class="progress-group">
                    <span class="progress-text">Step 3: Details of Categories</span>
<!--                     <span class="progress-number"><b>160</b>/200</span> -->

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-#3c8dbc" style="width: 60%"></div>
                    </div>
                  </div>
            </div>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
              <form method="post" class="form-horizontal" action="<?php echo base_url()?>competitions/finalstep/" accept-charset="utf-8"> 
              <div id="ch2" class="form-group">
                
                    <strong style="margin-right: 45px">Category name</strong>
                    <small style="margin-right: 7px">Category Type</small>
                    <small>Payment</small><br>
                    <div id="ch" class="btn-group">
                    <!-- Appended Items here bois  -->

                    </div>
               </div>

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary" href="$">Next</button>
                  </div>
              </form>
                
              </div>
          </div>
          <div class="col-md-5">
          </div>  
          </div> 
        </center>
    </section>
  </section>
<!--   <script>
$(document).ajaxStart(function() { Pace.restart(); });
  </script> -->
    <?php if(isset($_SESSION['user_id'])){ ?>
      <div id='ss_menu'>
        <div> <a href="/aayopayo/user"><i class="fa fa-tachometer-alt" title="dashboard"></i></a></div>
        <div> <a href="/aayopayo/logout.php"><i class="fa fa-sign-out-alt" title="logout"></i></a> </div>
        <div> <a href="/aayopayo/user/bidinfo.php"><i class="fa fa-credit-card" title="Your Credits"></i></a></div>
        <div> <a href="/aayopayo/logout.php"><i class="fa fa-user-circle" title="Your Accounts"></i></a> </div>
        <div class='menu'>
          <div class='share' id='ss_toggle' data-rot='180'>
            <div class='circle'></div>
            <div class='bar'></div>
          </div>
        </div>
      </div>
<?php    }  ?>

    <script>
    $(document).ready(function(ev) {
      var toggle = $('#ss_toggle');
      var menu = $('#ss_menu');
      var rot;

      $('#ss_toggle').on('click', function(ev) {
        rot = parseInt($(this).data('rot')) - 180;
        menu.css('transform', 'rotate(' + rot + 'deg)');
        menu.css('webkitTransform', 'rotate(' + rot + 'deg)');
        if ((rot / 180) % 2 == 0) {
          //Moving in
          toggle.parent().addClass('ss_active');
          toggle.addClass('close');
        } else {
          //Moving Out
          toggle.parent().removeClass('ss_active');
          toggle.removeClass('close');
        }
        $(this).data('rot', rot);
      });

      menu.on('transitionend webkitTransitionEnd oTransitionEnd', function() {
        if ((rot / 180) % 2 == 0) {
          $('#ss_menu div i').addClass('ss_animate');
        } else {
          $('#ss_menu div i').removeClass('ss_animate');
        }
      });

    });
    </script>
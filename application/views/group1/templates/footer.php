    
    </div>
    
    <!-- javascript necessary for navbar functionality -->
    <script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    <script>
    $(document).ready(function(){
        if($('.clickBait').attr('id') == 1){
            // click add user button
            $('#add_user').trigger('click');
        }
    });

    
    function checkPassword(theForm) {
        if (theForm.passwd.value != theForm.verify_passwd.value){
            alert('Those passwords don\'t match!');
            return false;
        } else {
            return true;
        }
    }
    </script>
    </body>
</html>
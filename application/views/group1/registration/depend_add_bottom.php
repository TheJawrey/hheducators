
        <div style="width: 100%; margin-top: 10px" class="container">
            <input type="hidden" name="action" value="addUser">
            <input type="hidden" name="selection" value="register"> 
            <button type="submit" class="btn btn-primary" name="add_user">Submit</button>
        </div>
    </form>

</div>


<script>
    function checkEmail(theForm) {
        if (theForm.email1.value != theForm.email2.value){
            alert('Those emails don\'t match!');
            return false;
        } else {
            return true;
        }
    }
</script>
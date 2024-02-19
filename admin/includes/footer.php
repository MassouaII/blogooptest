<footer>
    <div class="footer clearfix mb-0 text-muted">
        <div class="float-start">
            <p>2023 &copy; Mazer</p>
        </div>
        <div class="float-end">
            <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span>
                by <a href="https://saugi.me">Saugi</a></p>
        </div>
    </div>
</footer>
</div>
</div>
<script src="../admin/assets/static/js/components/dark.js"></script>
<script src="../admin/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>


<script src="../admin/assets/compiled/js/app.js"></script>



<!-- Need: Apexcharts -->
<script src="../admin/assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="../admin/assets/static/js/pages/dashboard.js"></script>
<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
    var quill = new Quill('#editor', {
        theme: 'snow'
    });
</script>

<?php
    ob_end_flush()
?>
</body>

</html>
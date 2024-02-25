<?php
if (isset($_COOKIE['msdn']) && $_COOKIE['msdn'] != "") { ?>
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright © 2023 by <a href="https://tpsoftct.vn" target="_blank">TPSoft</a></span>
            </div>
        </div>
    </footer>

    </div>
    </div>
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

<?php } ?>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" onclick="logout()">Logout</a>
            </div>
        </div>
    </div>
</div>
<script src="vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap core JavaScript-->
<script src="vendor/js/bootstrap-datepicker.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="vendor/js/sb-admin-2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#datepicker_tungay, #datepicker_denngay").datepicker({
            autoclose: true,
            todayHighlight: true
        });
        $('#datepicker_denngay').datepicker('update', new Date())
    });
</script>
<script>
    jQuery(document).ready(function($) {
        $('.txt_date').inputmask({
            mask: "1/2/y",
            placeholder: "dd/mm/yyyy",
            leapday: "29/02/",
            separator: "/",
            alias: "dd/mm/yyyy"
        });
    });
</script>

<script src="vendor/js/date_format.js"></script>
</body>

</html>
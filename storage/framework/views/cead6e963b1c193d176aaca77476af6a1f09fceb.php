    <footer id="footer" class="navbar-fixed-bottom text-center hidden-print">
        <div class="container clearfix">
            <!--
            <img src="<?php echo e(asset('images/dost_footer.png')); ?>" class="img-responsive pull-right" alt="DOST4A">            
            -->

            <div class="copyright">&copy; <script>
                    document.write(new Date().getFullYear())
                </script> by MIS Unit of <a href="http://region4a.dost.gov.ph" target="_blank">DOST CALABARZON</a>
            </div>
        </div>
    </footer>

    <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delete-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="delete-modal-label" class="modal-title">Confirm Delete</h4>
                </div>
                <div class="modal-body text-center">
                    You are about to delete a record.<br>
                    Continue?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">No</button>
                    <button type="button" id="btn-delete-yes" class="btn btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div> <!-- / #delete-modal -->

    <div id="confirm-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirm-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="confirm-modal-title" class="modal-title">Confirm Dialog Title</h4>
                </div>
                <div id="confirm-modal-message" class="modal-body text-center">Confirm Dialog Message</div>
                <div class="modal-footer">
                    <button type="button" id="confirm-btn-no" class="btn btn-success" data-dismiss="modal">No</button>
                    <button type="button" id="confirm-btn-yes" class="btn btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div> <!-- / #confirm-modal -->    
    <script src="<?php echo e(asset('js/jquery-3.2.1.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/bootstrap-datepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.tablesorter.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/jquery.tablesorter.pager.js')); ?>"></script>
    <script src="<?php echo e(asset('js/chosen.jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/custom.js')); ?>"></script>
</body>
</html>
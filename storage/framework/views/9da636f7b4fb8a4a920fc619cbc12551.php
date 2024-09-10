<!DOCTYPE html>
<html>

<head>
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <link rel="shortcut icon" href="<?php echo e(asset('images/favicon.png')); ?>" />
    <meta name="theme-color" content="#000000" />
    <meta name="author" content="" />
    <meta name="keyword" content="" />
    <meta name="description" content="" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo e(asset('css/material-icons.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/animate.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/blueimp-gallery.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap-theme-bootstrap.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/flatpickr.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/dropzone.min.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('css/custom-style.css')); ?>" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css" />

    <!-- DataTables JS -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js">
    </script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('css/custom.css')); ?>">
    <!-- jQuery (diperlukan untuk Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/jquery-3.3.1.min.js')); ?>"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <?php echo $__env->yieldContent('pagecss'); ?>
    <?php echo $__env->yieldContent('plugins'); ?>
    <script>
        var siteAddr = "<?php echo e(url('')); ?>/";
        var defaultPageLimit = 20;
        var csrfToken = "<?php echo e(csrf_token()); ?>";
        var requestErrorMessage = "Request Gagal!";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<?php
$body_id = 'index';
if (auth()->check()) {
    $body_id = 'main';
}
$page_name = request()->segment(1) ?? 'index';
$page_action = request()->segment(2) ?? 'index';
$body_class = "$page_name-$page_action";
?>

<body id="<?php echo $body_id; ?>" class="with-login <?php echo $body_class; ?>">
    <div id="page-wrapper">
        <!-- Show progress bar when ajax upload-->
        <div id="ajax-progress-bar" class="progress" style="display:none">
            <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                aria-valuemax="100" style="width:0"></div>
        </div>
        <?php echo $__env->make('appheader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div id="main-content">
            <!-- Page Main Content Start -->
            <div id="page-content">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
            <!-- Page Main Content [End] -->
            <!-- Page Footer Start -->
            <?php echo $__env->make('appfooter', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <!-- Page Footer Ends -->
            <!-- Modal page for displaying ajax page -->
            <div id="main-page-modal" class="modal right fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-body p-0 reset-grids inline-page">
                        </div>
                        <div style="top: 15px; right:5px; z-index: 999;" class="position-absolute">
                            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right SideDrawer for displaying ajax page -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="sidedrawer-page-modal">
                <div class="position-absolute" style="top: 20px; right:15px; z-index: 999;">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body p-0 reset-grids inline-page">
                </div>
            </div>
            <!-- Modal page for displaying record delete prompt -->
            <div class="modal fade" id="delete-record-modal-confirm" tabindex="-1" role="dialog"
                aria-labelledby="delete-record-modal-confirm" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete record</h5>
                            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div id="delete-record-modal-msg" class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <a href="" id="delete-record-modal-btn" class="btn btn-primary">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Image Preview Dialog -->
            <div id="preview-img-modal" class="modal fade" role="dialog">
                <div class="modal-dialog modal-dialog-centered mx-auto modal-lg">
                    <div class="modal-content mx-auto" style="width:auto;">
                        <div class="modal-body p-0 d-flex position-relative">
                            <img style="width:auto; max-width:100%; max-height:90vh;" class="mx-auto img" />
                            <button style="top: 10px; right:10px; z-index: 999;" type="button"
                                class="btn-close btn-close-white m-2 position-absolute"
                                data-bs-dismiss="modal"></button>
                        </div>
                    </div>
                </div>
            </div>
            <template id="saving-indicator">
                <div class="p-2 text-center m-2 text-muted">
                    <div class="lds-dual-ring"></div>
                    <h4 class="p-3 mt-2 font-weight-light">Menyimpan...</h4>
                </div>
            </template>
            <template id="loading-indicator">
                <div class="p-2 text-center d-flex justify-content-center align-items-center">
                    <span class="loader mr-3"></span>
                    <span class="px-2 text-muted font-weight-light">Loading...</span>
                </div>
            </template>
        </div>
        <div class="toast-container fixed-alert top-0 start-50 translate-middle-x pt-3">
            <div id="app-toast-success" data-bs-autohide="true" data-bs-delay="3000"
                class="animated bounceIn toast align-items-center text-bg-success" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="material-icons">check_circle</i>
                        <span class="msg"><?php echo e(Session::get('success')); ?></span>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
            <div id="app-toast-danger" data-bs-autohide="true" data-bs-delay="3000"
                class="animated bounceIn toast align-items-center text-bg-danger" role="alert"
                aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="material-icons">error</i>
                        <span class="msg"><?php echo e(Session::get('danger')); ?></span>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo e(asset('js/bootstrap.bundle.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/plugins/app-plugins.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/plugins/chartjs-3.3.2.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/plugins/flatpickr.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/plugins/dropzone.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/page-scripts.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/form-page-scripts.js')); ?>"></script>
    <?php echo $__env->yieldContent('pagejs'); ?>
    <script>
        var navTopHeight = $('#topbar').outerHeight();
        document.body.style.paddingTop = navTopHeight + 'px';
    </script>
    <script>
        window.onload = (event) => {
            <?php if(Session::has('success')): ?>
                let successAlert = document.getElementById('app-toast-success');
                let bsAlert = new bootstrap.Toast(successAlert);
                bsAlert.show();
            <?php endif; ?>
            <?php if(Session::has('danger')): ?>
                let errorAlert = document.getElementById('app-toast-danger');
                let bsAlert = new bootstrap.Toast(errorAlert);
                bsAlert.show();
            <?php endif; ?>
        }
    </script>
</body>

</html>
<?php /**PATH C:\laragon\www\sip\resources\views/layouts/app.blade.php ENDPATH**/ ?>
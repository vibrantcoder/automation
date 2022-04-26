<!--begin::Footer-->
<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            {{-- <span class="text-muted font-weight-bold mr-2"></span> --}}
            <a href="{{get_system_setting_detail()->footer_link}}" target="_blank" class="text-dark-75 text-hover-primary"><?php echo date("Y");?> &copy; {{get_system_setting_detail()->footer_text}}</a>
        </div>
        <!--end::Copyright-->
        <!--begin::Nav-->
        <div class="nav nav-dark">

        </div>
        <!--end::Nav-->
    </div>
    <!--end::Container-->
</div>
<!--end::Footer-->

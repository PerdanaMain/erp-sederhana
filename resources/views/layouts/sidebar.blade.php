<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo me-1">
            </span>
            <span class="app-brand-text demo menu-text fw-semibold ms-2">Elitech ERP</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="mdi menu-toggle-icon d-xl-block align-middle mdi-20px"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item active open">
            <ul class="menu-sub">
                <li class="menu-item {{ Route::currentRouteName() == 'purchase.index' ? 'active' : '' }}">
                    <a href="{{ route('purchase.index') }}" class="menu-link">
                        <div data-i18n="Pembelian">Pembelian</div>
                    </a>
                </li>
                <li class="menu-item  {{ Route::currentRouteName() == 'warehouse.index' ? 'active' : '' }}">
                    <a href="{{ route('warehouse.index') }}" class="menu-link">
                        <div data-i18n="Gudang">Gudang</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Layouts -->

    </ul>
</aside>

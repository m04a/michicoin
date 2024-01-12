<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-dashboard nav-icon"></i> {{ trans('admin.dashboard') }}</a></li>
@if(backpack_user()->hasPermissionTo('list pages') || backpack_user()->root)
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('page') }}'><i class='nav-icon la la-file-o'></i> <span>{{ trans('admin.pages') }}</span></a></li>
@endif
@if(env('FNX_ENTRIES',FALSE) && (backpack_user()->hasPermissionTo('list entries') || backpack_user()->root))
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('entry') }}'><i class='nav-icon la la-newspaper'></i> <span>{{ trans('admin.entries') }}</span></a></li>
@endif

@if(hasModule('Fnxshop'))

<!-- INICI SHOP -->
<li class='nav-item nav-dropdown'>
	<a class='nav-link nav-dropdown-toggle' href='#'><i class='nav-icon la la-shopping-cart'></i> {{__('shop.orders')}}</a>
	<ul class='nav-dropdown-items'>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('shop/order') }}'><i class='nav-icon la la-shopping-cart'></i> {{__('shop.orders')}}</a></li>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('shop/order/status') }}'><i class='nav-icon la la-tag'></i> {{__('shop.order_status')}}</a></li>
	</ul>
</li><li class='nav-item nav-dropdown'>
	<a class='nav-link nav-dropdown-toggle' href='#'><i class='nav-icon la la-users'></i> {{__('shop.customers')}}</a>
	<ul class='nav-dropdown-items'>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('shop/customer') }}'><i class='nav-icon la la-users'></i> {{__('shop.customers')}}</a></li>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('shop/customer/group') }}'><i class='nav-icon la la-tag'></i> {{__('shop.customer_groups')}}</a></li>
	</ul>
</li>

<li class='nav-item nav-dropdown'>
	<a class='nav-link nav-dropdown-toggle' href='#'><i class='nav-icon la la-truck'></i> {{__('shop.shipping')}}</a>
	<ul class='nav-dropdown-items'>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('shop/carrier') }}'><i class='nav-icon la la-truck'></i> {{__('shop.carriers')}}</a></li>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('shop/zone') }}'><i class='nav-icon la la-atlas'></i> {{__('shop.zones')}}</a></li>

		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('shop/country') }}'><i class='nav-icon la la-globe'></i> {{__('shop.countries')}}</a></li>
		<li class='nav-item'><a class='nav-link' href='{{ backpack_url('shop/region') }}'><i class='nav-icon la la-map-marked-alt'></i> {{__('shop.regions')}}</a></li>

	</ul>
</li>

<li class='nav-item'><a class='nav-link' href='{{ backpack_url('shop/tax') }}'><i class='nav-icon la la-percent'></i> {{__('shop.tax')}}</a></li>
<!-- FI SHOP -->
@endif
@if(backpack_user()->can('list menus') || backpack_user()->root)
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('menu-item') }}'><i class='nav-icon la la-sitemap'></i> <span>{{ trans('admin.menu') }}</span></a></li>
@endif

@if(backpack_user()->can('list gdpr') || backpack_user()->root)
<li class="nav-item nav-dropdown">
	<a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-toggle-off"></i> GDPR</a>
	<ul class="nav-dropdown-items">
	  <li class='nav-item'><a class='nav-link' href='{{ backpack_url('fnxcookiecategory') }}'><i class='nav-icon la la-toggle-on'></i> {{ trans('admin.cookie_categories') }}</a></li>
	  <li class='nav-item'><a class='nav-link' href='{{ backpack_url('fnxcookie') }}'><i class='nav-icon la la-toggle-off'></i> {{ trans('admin.cookies') }}</a></li>
	</ul>
</li>
@endif
@if(backpack_user()->can('translates') || backpack_user()->root)
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('translates/list') }}'><i class='nav-icon la la-language'></i> <span>{{ trans('admin.translates') }}</span></a></li>
@endif
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('elfinder') }}\"><i class="nav-icon la la-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
<!-- Users, Roles, Permissions -->
@if(backpack_user()->root)
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-users"></i> {{ trans('admin.users') }}</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>{{ trans('admin.users') }}</span></a></li>
	
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('role') }}"><i class="nav-icon la la-id-badge"></i> <span>{{ trans('admin.roles') }}</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('permission') }}"><i class="nav-icon la la-key"></i> <span>{{ trans('admin.permissions') }}</span></a></li>
	
    </ul>
</li>
@elseif(backpack_user()->can('users'))
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="nav-icon la la-user"></i> <span>{{ trans('admin.users') }}</span></a></li>
@endif

@if(backpack_user()->can('settings') || backpack_user()->root)
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('fnxsettings') }}'><i class='nav-icon la la-cog'></i> {{ trans('admin.settings') }}</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('email/config') }}'><i class='nav-icon la la-envelope'></i> {{ trans('admin.email_cfg') }}</a></li>

@endif


@if(backpack_user()->root)
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('theme') }}'><i class='nav-icon la la-palette'></i> {{ trans('admin.themes') }}</a></li>
@endif


@if(env('FNX_SAVE_SENDFORMS',FALSE) )
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contact-send') }}'><i class='nav-icon la la-envelope'></i> {{ trans('admin.contact_sends') }}
<?php $pending = \App\Models\ContactSend::where('readed',0)->count(); ?>
@if($pending>0)
<span class="badge badge-sm bg-info">{{$pending}}</span>
@endif
</a></li>
@endif

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('help/see') }}"><i class="nav-icon la la-question"></i> <span>{{ trans('admin.help') }}</span></a></li>

@if(backpack_user()->root)
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-question"></i> {{ trans('admin.help') }}</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('help') }}"><i class="nav-icon la la-question"></i> <span>{{ trans('admin.help') }}</span></a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('helpcat') }}"><i class="nav-icon la la-box"></i> <span>{{ trans('admin.categories') }}</span></a></li>
    </ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('redirection') }}'><i class='nav-icon la la-directions'></i> {{ trans('admin.redirections') }}</a></li>
@endif

Name            : psmCore
Summary         : Content management framework
Version         : 3.6.%{BUILD_NUMBER}
Release         : 1
BuildArch       : noarch
Requires        : php >= 5.6.0
Requires        : gd
Provides        : php-psmCore
Prefix          : /usr/local/lib/php/psmCore
%define  _rpmfilename  %%{NAME}-%%{VERSION}-%%{RELEASE}.noarch.rpm

License         : [[TBA]]
Group           : Development/PHP
Packager        : PoiXson <support@poixson.com>
URL             : http://psm.poixson.com/

%description
Content management framework for php websites. This package allows the framework to be shared between websites.



%build
# build apache include file
%{__cat} <<EOF >psmCore.conf

<Directory "/usr/local/lib/php/psmCore">
	Options -Indexes
	AllowOverride None

	# Apache 2.4
	<IfModule mod_authz_core.c>
		Require all granted
	</IfModule>
	# Apache 2.2
	<IfModule !mod_authz_core.c>
		Order Deny,Allow
		Allow from all
	</IfModule>

</Directory>
Alias /psmCore /usr/local/lib/php/psmCore

EOF
# build php include file
%{__cat} <<EOF >psmCore.ini

include_path = ".:/usr/local/lib/php"

EOF



%install
echo
echo "Install.."
# delete existing rpm's
%{__rm} -fv "%{_rpmdir}/%{name}"*.noarch.rpm
# create directories
%{__install} -d -m 0755 \
	"${RPM_BUILD_ROOT}%{prefix}/Utils"    \
	"${RPM_BUILD_ROOT}/etc/httpd/conf.d/" \
	"${RPM_BUILD_ROOT}/etc/php.d/"        \
		|| exit 1
#	"${RPM_BUILD_ROOT}%{prefix}/engine"   \
#		"${RPM_BUILD_ROOT}%{prefix}/engine/template" \
#	"${RPM_BUILD_ROOT}%{prefix}/pages"    \
#	"${RPM_BUILD_ROOT}%{prefix}/portal"   \
#	"${RPM_BUILD_ROOT}%{prefix}/pxdb"     \
#	"${RPM_BUILD_ROOT}%{prefix}/widgets"  \
#		"${RPM_BUILD_ROOT}%{prefix}/widgets/blog"    \
# copy .php files
for phpfile in \
	'Portal.php' \
	'Init.php' \
	'Paths.php' \
	'Page.php' \
	'PageRoute.php' \
	'Utils/General.php' \
		'Utils/Numbers.php' \
		'Utils/qTime.php' \
		'Utils/San.php' \
; do
#	'core.php'                          \
#	'inc.php'                           \
#	'ClassLoader.php'                   \
#	'config.php.original'               \
#	'engine/engine.class.php'           \
#		'engine/loader.class.php'           \
#		'engine/block.class.php'            \
#		'engine/template/template_interface.class.php' \
#		'engine/template/phpclss.class.php' \
#		'engine/template/tpl.class.php'     \
#	'pages/home.php'                    \
#	'portal/portal.class.php'           \
#		'portal/module.class.php'           \
#		'portal/page_interface.class.php'   \
#		'portal/website.class.php'          \
#	'pxdb/pxdb.class.php'               \
#		'pxdb/dbPool.class.php'             \
#		'pxdb/dbQuery.class.php'            \
#	'utils/utils.class.php'             \
#		'utils/csrf.class.php'              \
#		'utils/numbers.class.php'           \
#		'utils/PassCrypt.class.php'         \
#		'utils/san.class.php'               \
#		'utils/strings.class.php'           \
#		'utils/vars.class.php'              \
#	'widgets/widget_interface.class.php' \
#		'widgets/blog/blog.class.php'       \
	%{__install} -m 0555 \
		"%{SOURCE_ROOT}/lib/${phpfile}" \
		"${RPM_BUILD_ROOT}%{prefix}/${phpfile}" \
			|| exit 1
done
# copy psmCore.conf apache config
%{__install} -m 644 \
	"psmCore.conf" \
	"${RPM_BUILD_ROOT}/etc/httpd/conf.d/psmCore.conf" \
		|| exit 1
# copy psmCore.ini php config
%{__install} -m 644 \
	"psmCore.ini" \
	"${RPM_BUILD_ROOT}/etc/php.d/psmCore.ini" \
		|| exit 1



%clean
if [ ! -z "%{_topdir}" ]; then
	%{__rm} -rf --preserve-root "%{_topdir}" \
		|| echo "Failed to delete build root (probably fine..)"
fi



### Files ###
%files
%defattr(-,root,root,-)
%{prefix}/Portal.php
%{prefix}/Init.php
%{prefix}/Paths.php
%{prefix}/Page.php
%{prefix}/PageRoute.php
%{prefix}/Utils/General.php
%{prefix}/Utils/Numbers.php
%{prefix}/Utils/qTime.php
%{prefix}/Utils/San.php
#%{prefix}/core.php
#%{prefix}/inc.php
#%{prefix}/ClassLoader.php
#%{prefix}/config.php.original
#%{prefix}/engine/engine.class.php
#%{prefix}/engine/loader.class.php
#%{prefix}/engine/block.class.php
#%{prefix}/engine/template/template_interface.class.php
#%{prefix}/engine/template/phpclss.class.php
#%{prefix}/engine/template/tpl.class.php
#%{prefix}/pages/home.php
#%{prefix}/portal/portal.class.php
#%{prefix}/portal/module.class.php
#%{prefix}/portal/page_interface.class.php
#%{prefix}/portal/website.class.php
#%{prefix}/pxdb/pxdb.class.php
#%{prefix}/pxdb/dbPool.class.php
#%{prefix}/pxdb/dbQuery.class.php
#%{prefix}/utils/csrf.class.php
#%{prefix}/utils/numbers.class.php
#%{prefix}/utils/PassCrypt.class.php
#%{prefix}/utils/san.class.php
#%{prefix}/utils/strings.class.php
#%{prefix}/utils/utils.class.php
#%{prefix}/utils/vars.class.php
#%{prefix}/widgets/widget_interface.class.php
#%{prefix}/widgets/blog/blog.class.php
/etc/httpd/conf.d/psmCore.conf
/etc/php.d/psmCore.ini

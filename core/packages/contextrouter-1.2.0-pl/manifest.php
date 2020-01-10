<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'license' => 'Copyright 2012 Mark Hamstra

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.',
    'readme' => '++  ContextRouter
++++++++++++++++++++

ContextRouter is a simple plug-and-play plugin allowing you to route different contexts based on the http_host context
settings that you need to set anyway.

In essence it\'s like the Gateway plugin from the docs, except you don\'t have to manually edit the plugin: it takes
the settings you have already configured in your context, caches it and routes based on that.

GETTING STARTED
1. Install the plugin (you\'re working on that, good job!)
2. Make sure your contexts have http_host context settings set.
3. (optional) Assign http_host_aliases context settings where needed to alias other hosts.
4. Clear cache via Site > Clear Cache to rebuild the cache file.

If you need routing based on subfolders as well, then it\'s recommended to use xRouting instead, which is a more powerful alternative.
',
    'changelog' => 'ContextRouter 1.2.0-pl
----------------------
Released on 2018-12-05

- Work around modContext ACLs to prevent sites from becoming inaccessible when a non-authorized user causes the cache to be cleared [#5]
- Allow using OnMODXInit instead of OnHandleRequest event
- Minor codes style tweaks
- License updated to MIT instead of GPL v2

ContextRouter 1.1.0-pl
----------------------
Released on 2012-07-18

(pl2) Fix unproperly prefixed system settings.
Big refactoring, now has a class handling the thinking.
#2 Added includeWww option (ON by default) which optionally also looks out for www.* hosts.
#3 Added support for http_host_aliases context setting, which allows different http_host values routing to one context.


ContextRouter 1.0.0-pl
----------------------
Released on 2011-11-18

First release.
',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => 'e2072cb6441157f2f9b80a81c224e1c0',
      'native_key' => 'contextrouter',
      'filename' => 'modNamespace/6e07b6994c646faeb394b31423738338.vehicle',
      'namespace' => 'contextrouter',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modPlugin',
      'guid' => '8982abd3470f890f8b62f46f09821ac5',
      'native_key' => 1,
      'filename' => 'modPlugin/1affed33f8ddb8f585275eae5320ac50.vehicle',
      'namespace' => 'contextrouter',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'd917167a629a5013f2a0cbbd4d0fbecf',
      'native_key' => 'contextrouter.includeWww',
      'filename' => 'modSystemSetting/08299cb2997a3ebfe3f8782f9d6645cb.vehicle',
      'namespace' => 'contextrouter',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a8e13115448eba035465bb5070217706',
      'native_key' => 'contextrouter.defaultContext',
      'filename' => 'modSystemSetting/6dba7e67685c4851c69fb4dfeb728f90.vehicle',
      'namespace' => 'contextrouter',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modCategory',
      'guid' => '08ea7480f209d760ecf69800000e9a47',
      'native_key' => 1,
      'filename' => 'modCategory/2307b1e04b11be3b7bf1c15cd2c457b4.vehicle',
      'namespace' => 'contextrouter',
    ),
  ),
);
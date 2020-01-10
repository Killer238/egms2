<?php
$tmp = array("sdfsdf","sfdf");
$product_alias = array_shift($tmp);
$thed = array_shift($tmp);

print $product_alias;
print "\n\t";
print $thed;
if($thed)
    print "set";
else
    print "not set";
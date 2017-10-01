
/*------------------------------------------------------------------------
# Common support functions
# ------------------------------------------------------------------------
# author:    Dmitry Zhuk
# copyright: Copyright (C) 2013 zhuk.cc. All Rights Reserved.
# license:   http://creativecommons.org/licenses/by-nc-nd/4.0/
#            Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License.
# website:   http://zhuk.cc
# Technical Support Forum: http://forum.zhuk.cc/
-------------------------------------------------------------------------*/
function Convert_Latitude_Decimal2DMS(cL){var fd;var eT;var eP="°";var fK="'";var fp="\"";var fA="";if((typeof cL!=='undefined')&&cL!=""&&cL!=null){if(cL=="-"){eT='S';fd=cL.substr(1,cL.length-1);}else{eT='N';fd=cL;}var eC,eJ,ek,dV,fc;dV=fd.toString().split(".");eC=dV[0];fc=dV[1];if((typeof fc!=='undefined')&&(fc!=null)){}else{fc="0";}fc=("0."+fc)*60;dV=fc.toString().split(".");eJ=dV[0];fc=dV[1];if((typeof fc!=='undefined')&&(fc!=null)){}else{fc="0";}fc=("0."+fc)*60;ek=fc.toFixed(1);fA=eC+eP+""+eJ+fK+""+ek+fp+""+eT;}return fA;};function Convert_Longitude_Decimal2DMS(cL){var fd;var eT;var eP="°";var fK="'";var fp="\"";var fA="";if((typeof cL!=='undefined')&&cL!=""&&cL!=null){if(cL=="-"){eT='W';fd=cL.toString().substr(1,cL.length-1);}else{eT='E';fd=cL;}var eC,eJ,ek,dV,fc;dV=fd.toString().split(".");eC=dV[0];fc=dV[1];if((typeof fc!=='undefined')&&(fc!=null)){}else{fc="0";}fc=("0."+fc)*60;dV=fc.toString().split(".");eJ=dV[0];fc=dV[1];if((typeof fc!=='undefined')&&(fc!=null)){}else{fc="0";}fc=("0."+fc)*60;ek=fc.toFixed(1);fA=eC+eP+""+eJ+fK+""+ek+fp+""+eT;}return fA;} 
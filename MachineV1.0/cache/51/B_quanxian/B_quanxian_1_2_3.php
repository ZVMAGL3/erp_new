<?php
include_once "{$_SERVER['PATH_TRANSLATED']}/session.php";
$const_q_zu='总经理,采购员,客服部主管';
$const_id_fz='96';
$const_id_bumen='43,44,45';
$const_bumenname='总经办';
$const_q_fanwei='268_0,190_1,248_3,272_2,225_3,223_3,495_3,437_3,438_3,471_3,204_3,388_3,214_3,494_3,497_3,280_3,314_3,256_3,315_3,501_3,502_3,264_3,463_3,281_3,503_3,504_3,505_3,506_3,507_3,508_3,509_3,499_3,510_3,262_3,391_3,404_3,294_3,257_3,511_3,512_3,513_3,461_3,423_3,321_3,472_2,474_3,473_3,263_3,308_3,517_3,248_1,494_1';
$const_q_tianj='191,199,270,280,225,223,471,423,495,499,388,314,256,281,502,264,463,315,494,497,503,504,505,506,507,508,509,501,510,391,257,511,204,308,321,437,438,472,473,474,475,476,478,477,207,208,209,210,216,227,228,229,306,326,387,217,218,307,319,320,330,190,248,250,268,269,517,519,520,521,522,523,524,525,526,527,528,272,401,402,403,405,466,202,467,468,203,232,233,234,235,485,486,487,488,489,490,200,201,245,465,213,212,214,215,230,284,285,318,323,328,399,411,385,491,492,493,231,324,469,470,192,197,198,205,206,211,236,237,312,294,313,289,290,291,292,219,220,221,222,224,259,286,287,288,386,392,393,395,496,479,480,238,239,240,241,242,243,244,246,481,482,483,484,295,296,297,298,299,300,301,302,303,304,305,389,400,513,251,252,253,254,255,258,261,262,263,265,266,267,309,329,368,382,384,462,514,515,516,277,282,293,310,311,404,442,445,512,461,226';
$const_q_xiug='191,199,270,280,225,223,471,423,495,499,388,314,256,281,502,264,463,204,315,494,497,503,504,505,506,507,508,509,501,510,391,257,511,308,321,437,438,472,473,474,475,476,478,477,207,208,209,210,216,227,228,229,306,326,387,217,218,307,319,320,330,190,248,250,268,269,517,519,520,521,522,523,524,525,526,527,528,272,401,402,403,405,466,202,467,468,203,232,233,234,235,485,486,487,488,489,490,200,201,245,465,213,212,214,215,230,284,285,318,323,328,399,411,385,491,492,493,231,324,469,470,192,197,198,205,206,211,236,237,312,294,313,289,290,291,292,219,220,221,222,224,259,286,287,288,386,392,393,395,496,479,480,238,239,240,241,242,243,244,246,481,482,483,484,295,296,297,298,299,300,301,302,303,304,305,389,400,513,251,252,253,254,255,258,261,262,263,265,266,267,309,329,368,382,384,462,514,515,516,277,282,293,310,311,404,442,445,512,461,226';
$const_q_shenghe='471,423,495,499,223,225,280,388,314,256,281,502,264,463,501,204,315,494,497,503,504,505,506,507,508,509,510,391,257,511,308,321,437,438,472,473,474,475,476,478,477,207,208,209,210,216,227,228,229,306,326,387,217,218,307,319,320,330,190,248,250,268,269,517,519,520,521,522,523,524,525,526,527,528,272,401,402,403,405,466,202,467,468,203,232,233,234,235,485,486,487,488,489,490,200,201,245,465,213,212,214,215,230,284,285,318,323,328,399,411,385,491,492,493,231,324,469,470,192,197,198,205,206,211,236,237,312,294,313,289,290,291,292,219,220,221,222,224,259,286,287,288,386,392,393,395,496,479,480,238,239,240,241,242,243,244,246,481,482,483,484,295,296,297,298,299,300,301,302,303,304,305,389,400,513,251,252,253,254,255,258,261,262,263,265,266,267,309,329,368,382,384,462,514,515,516,277,282,293,310,311,404,442,445,512,461,226';
$const_q_pizhun='471,423,495,499,223,225,280,388,314,256,281,502,264,463,501,204,315,494,497,503,504,505,506,507,508,509,510,391,257,511,308,321,437,438,472,473,474,475,476,478,477,207,208,209,210,216,227,228,229,306,326,387,217,218,307,319,320,330,190,248,250,268,269,517,519,520,521,522,523,524,525,526,527,528,272,401,402,403,405,466,202,467,468,203,232,233,234,235,485,486,487,488,489,490,200,201,245,465,213,212,214,215,230,284,285,318,323,328,399,411,385,491,492,493,231,324,469,470,192,197,198,205,206,211,236,237,312,294,313,289,290,291,292,219,220,221,222,224,259,286,287,288,386,392,393,395,496,479,480,238,239,240,241,242,243,244,246,481,482,483,484,295,296,297,298,299,300,301,302,303,304,305,389,400,513,251,252,253,254,255,258,261,262,263,265,266,267,309,329,368,382,384,462,514,515,516,277,282,293,310,311,404,442,445,512,461,226';
$const_q_zhixing='391,257,511,308,321,495,501,423,437,438,471,472,473,474,475,476,478,477,207,208,209,210,216,227,228,229,306,326,387,217,218,307,319,320,330,499,510,190,248,250,268,269,517,519,520,521,522,523,524,525,526,527,528,272,401,402,403,405,466,202,467,468,203,232,233,234,235,485,486,487,488,489,490,200,201,245,502,465,213,212,214,215,230,284,285,318,323,328,399,411,385,491,492,493,231,324,469,470,192,197,198,205,206,211,236,237,312,294,313,494,315,497,503,504,505,507,506,508,509,204,289,290,291,292,219,220,221,222,224,225,259,286,287,288,314,386,392,393,223,395,496,479,480,238,239,240,241,242,243,244,246,481,482,483,484,295,296,297,298,299,300,301,302,303,304,305,389,400,513,251,252,253,254,255,256,258,261,262,263,264,265,266,267,309,329,368,382,384,388,462,463,514,515,516,277,280,281,282,293,310,311,404,442,445,512,461,226';
$const_q_shanc='191,199,270,280,225,223,471,423,495,499,388,314,256,281,502,264,463,501,204,315,494,497,503,504,505,506,507,508,509,510,391,257,511,308,321,437,438,472,473,474,475,476,478,477,207,208,209,210,216,227,228,229,306,326,387,217,218,307,319,320,330,190,248,250,268,269,517,519,520,521,522,523,524,525,526,527,528,272,401,402,403,405,466,202,467,468,203,232,233,234,235,485,486,487,488,489,490,200,201,245,465,213,212,214,215,230,284,285,318,323,328,399,411,385,491,492,493,231,324,469,470,192,197,198,205,206,211,236,237,312,294,313,289,290,291,292,219,220,221,222,224,259,286,287,288,386,392,393,395,496,479,480,238,239,240,241,242,243,244,246,481,482,483,484,295,296,297,298,299,300,301,302,303,304,305,389,400,513,251,252,253,254,255,258,261,262,263,265,266,267,309,329,368,382,384,462,514,515,516,277,282,293,310,311,404,442,445,512,461,226';
$const_q_cak='191,199,270,280,225,223,471,423,495,499,388,314,256,281,502,264,463,501,204,315,494,497,503,504,505,506,507,508,509,510,391,257,511,472,308,321,437,438,473,474,475,476,478,477,207,208,209,210,216,227,228,229,306,326,387,217,218,307,319,320,330,190,248,250,268,269,517,519,520,521,522,523,524,525,526,527,528,272,401,402,403,405,466,202,467,468,203,232,233,234,235,485,486,487,488,489,490,200,201,245,465,213,212,214,215,230,284,285,318,323,328,399,411,385,491,492,493,231,324,469,470,192,197,198,205,206,211,236,237,312,294,313,289,290,291,292,219,220,221,222,224,259,286,287,288,386,392,393,395,496,479,480,238,239,240,241,242,243,244,246,481,482,483,484,295,296,297,298,299,300,301,302,303,304,305,389,400,513,251,252,253,254,255,258,261,262,263,265,266,267,309,329,368,382,384,462,514,515,516,277,282,293,310,311,404,442,445,512,461,226';
$const_q_dayin='191,199,280,225,223,471,423,495,499,388,314,256,281,502,264,463,501,204,315,494,497,503,504,505,506,507,508,509,510,391,257,511,308,321,437,438,472,473,474,475,476,478,477,207,208,209,210,216,227,228,229,306,326,387,217,218,307,319,320,330,190,248,250,268,269,517,519,520,521,522,523,524,525,526,527,528,272,401,402,403,405,466,202,467,468,203,232,233,234,235,485,486,487,488,489,490,200,201,245,465,213,212,214,215,230,284,285,318,323,328,399,411,385,491,492,493,231,324,469,470,192,197,198,205,206,211,236,237,312,294,313,289,290,291,292,219,220,221,222,224,259,286,287,288,386,392,393,395,496,479,480,238,239,240,241,242,243,244,246,481,482,483,484,295,296,297,298,299,300,301,302,303,304,305,389,400,513,251,252,253,254,255,258,261,262,263,265,266,267,309,329,368,382,384,462,514,515,516,277,282,293,310,311,404,442,445,512,461,226';
$const_q_xiaohui='495,501,510,264,391,257,511,308,321,423,437,438,471,472,473,474,475,476,478,477,207,208,209,210,216,227,228,229,306,326,387,217,218,307,319,320,330,499,190,248,250,268,269,517,519,520,521,522,523,524,525,526,527,528,272,401,402,403,405,466,202,467,468,203,232,233,234,235,485,486,487,488,489,490,200,201,245,502,465,213,212,214,215,230,284,285,318,323,328,399,411,385,491,492,493,231,324,469,470,192,197,198,205,206,211,236,237,312,294,313,494,315,497,503,504,505,507,506,508,509,204,289,290,291,292,219,220,221,222,224,225,259,286,287,288,314,386,392,393,223,395,496,479,480,238,239,240,241,242,243,244,246,481,482,483,484,295,296,297,298,299,300,301,302,303,304,305,389,400,513,251,252,253,254,255,256,258,261,262,263,265,266,267,309,329,368,382,384,388,462,463,514,515,516,277,280,281,282,293,310,311,404,442,445,512,461,226';
$const_q_huis='191,199,270,280,225,223,471,423,495,499,388,314,256,281,502,264,463,501,204,315,494,497,503,504,505,506,507,508,509,510,391,257,511,308,321,437,438,472,473,474,475,476,478,477,207,208,209,210,216,227,228,229,306,326,387,217,218,307,319,320,330,190,248,250,268,269,517,519,520,521,522,523,524,525,526,527,528,272,401,402,403,405,466,202,467,468,203,232,233,234,235,485,486,487,488,489,490,200,201,245,465,213,212,214,215,230,284,285,318,323,328,399,411,385,491,492,493,231,324,469,470,192,197,198,205,206,211,236,237,312,294,313,289,290,291,292,219,220,221,222,224,259,286,287,288,386,392,393,395,496,479,480,238,239,240,241,242,243,244,246,481,482,483,484,295,296,297,298,299,300,301,302,303,304,305,389,400,513,251,252,253,254,255,258,261,262,263,265,266,267,309,329,368,382,384,462,514,515,516,277,282,293,310,311,404,442,445,512,461,226';
$const_q_seid='280,225,223,471,423,495,499,388,314,256,281,502,264,463,501,204,315,494,497,503,504,505,506,507,508,509,510,391,257,511,308,321,437,438,472,473,474,475,476,478,477,207,208,209,210,216,227,228,229,306,326,387,217,218,307,319,320,330,190,248,250,268,269,517,519,520,521,522,523,524,525,526,527,528,272,401,402,403,405,466,202,467,468,203,232,233,234,235,485,486,487,488,489,490,200,201,245,465,213,212,214,215,230,284,285,318,323,328,399,411,385,491,492,493,231,324,469,470,192,197,198,205,206,211,236,237,312,294,313,289,290,291,292,219,220,221,222,224,259,286,287,288,386,392,393,395,496,479,480,238,239,240,241,242,243,244,246,481,482,483,484,295,296,297,298,299,300,301,302,303,304,305,389,400,513,251,252,253,254,255,258,261,262,263,265,266,267,309,329,368,382,384,462,514,515,516,277,282,293,310,311,404,442,445,512,461,226';
$const_q_dian='';
$regid='';
$reg_name='';
$reg_banben='';
$data_use='';
$const_jlbhzt='';
$maxrecord='30';
if ( $maxrecord == '' )$maxrecord = 20;
$nowlockd='';
$usermoban='';
$nowgsbh='';
?>
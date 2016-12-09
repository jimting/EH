< script>
var urlPath ='index';
var urlHref = location.href;

// 如果是手機端訪問首頁， 跳至行動手機版網頁
var arrUrl_webgolds = ['index','post'];  // 緩存頁面做跳轉/
for(i in arrUrl_webgolds) {
  if(arrUrl_webgolds[i] == urlPath) {
    if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) { //使用javascript回傳使用者瀏覽裝置的版本
      urlHref = urlHref.replace(urlPath,'mobile/'+urlPath);
      if(location.pathname === '/') {
        urlHref='login.html'; //直接轉到行動版首頁
      }
      //window.location.href(urlHref); //轉址
      alert(urlHref);
      break;
    }
    else
    {
    alert('目前使用電腦版瀏覽，不必轉換');
    }
  }
}
< /script>
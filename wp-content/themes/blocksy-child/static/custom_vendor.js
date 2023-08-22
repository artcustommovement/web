// 修改登录注册页面的become an vendor
document.addEventListener("DOMContentLoaded", function() {
    var links = document.querySelectorAll(".wcfmmp_become_vendor_link a");
    if (links.length > 0) {
        links.forEach(function(link) {
            link.innerHTML = "BECOME AN ARTIST";
        });
    }
});
        

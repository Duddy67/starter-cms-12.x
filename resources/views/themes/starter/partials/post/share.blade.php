  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Share this page</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="social-share share-model__twitter" onclick="share('twitter')">
              <div class="share-model__twitter-text">
                  Share on <span>Twitter</span>
              </div>
          </div>
          <div class="social-share share-model__facebook" onclick="share('facebook')">
              <div class="share share-model__facebook-text">
                  Share on <span>Facebook</span>
              </div>
          </div>
          <div class="share-model__copy" onclick="copyToClipboard()">
              <div id="copyUrl"
                   class="share-model__copy-text">
                  Copy URL {{ url()->current() }}
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>

<script>
    function copyToClipboard() {
        const input = document.body.appendChild(document.createElement("input"));
        input.value = window.location.href;
        input.select();
        document.execCommand('copy');
        input.parentNode.removeChild(input);
        console.log('Text copied!');
        /*$('#copyUrl').text('copied!');
        setTimeout(()=>{
            $('#copyUrl').text('Copy URL');
        }, 3000)*/
    }

    function share(social) {
        const networks = {
            facebook: "https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}&target=_blank&quote=wel laravel tutorial",
            twitter: "https://x.com/intent/tweet?text=Laravel Package tutorial&url={{urlencode(url()->current())}}&via=LPT",
        };

        // Open the social network page in a new tab.
        window.open(networks[social], '_blank').focus();
    }
</script>


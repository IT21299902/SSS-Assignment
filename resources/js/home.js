$('#chatModal').on('shown.bs.modal', function (e) {
  document.getElementById("message-text").focus();
  modalIsOpen = true;
  ajaxDisplayMessages("displayAll");
  ajaxTypingReady();
  ajaxDiffieHellman();
})



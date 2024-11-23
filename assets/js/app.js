const sign_in_btn = document.querySelector("#sign-in-btn"); //hay bs la erbt kbse m3 css bs ekbos 3a signup yfth 3nde signup mode
const sign_up_btn = document.querySelector("#sign-up-btn");//w bs ekbs 3 sigin byt7awl 3nde la mode sign in b eno el8e mode sign up-mode css
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});
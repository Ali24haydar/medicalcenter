const switchers = [...document.querySelectorAll('.switcher')] //3m jib kl le 3=7mlin .switcher le ms2ulin 3n mode eno bs kun drk mode yn3ml switch
//d8ri la be2e sf7at bs en2ol msh sf7a ee sf7a la
switchers.forEach(item => {
	item?.addEventListener('click', function() {
		switchers.forEach(item => item.parentElement.classList.remove('is-active'))
		this.parentElement.classList.add('is-active')
	})
})

let viewMode = document.getElementById("viewMode");
let changeMode = document.getElementById("changeMode");
let viewWrapper = document.getElementById("viewWrapper");
let changeWrapper = document.getElementById("changeWrapper");
viewMode?.addEventListener("click", ()=> { 
	changeWrapper.classList.remove('is-active');
	viewWrapper.classList.add('is-active');
});

changeMode?.addEventListener("click", ()=> {
	viewWrapper.classList.remove('is-active');
	changeWrapper.classList.add('is-active');
});
	
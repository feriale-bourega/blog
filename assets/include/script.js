window.addEventListener("DOMContentLoaded", () => {
  const select = document.getElementById("list-deroulant");

  select.addEventListener("change", function handleChange(event) {
    console.log(event.target.value); // 👉️ get selected VALUE
    let idcategorie = event.target.value;

    window.location='./categorie.php?categorie=' + idcategorie;
    // 👇️ get selected VALUE even outside event handler
    console.log(select.options[select.selectedIndex].value);

    // 👇️ get selected TEXT in or outside event handler
    console.log(select.options[select.selectedIndex].text);
  });
});

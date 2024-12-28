

let test = document.getElementsByClassName("stats");
for (let i = 0 ; i < test.length; i++) {
    test[i].addEventListener("click", function() {
        console.log(test.item(i).id);
        db = connect( 'mongodb+srv://cluster0.qbe0v.mongodb.net/' );
        db.animals.updateOne({"animal_id" : (test.item(i).id) }, { $inc : { "views": 1 }});

    })};



*********

let test = 'test';
console.log(test);

let test = document.getElementsByClassName("stats");
console.log(test.item(1));
console.log(test.namedItem(5));
console.log(test.namedItem(5).id);
const lion = (test[0]);
console.log(lion.id);
console.log(test);
var arr = Array.from(test);
console.log(arr[0].id);

for (let i=0; i < test.length; i++) {
    addEventListener("click", function() {
        let item = test[i];
        console.log(item.id);
        if (item.id != 1) {
            console.log('lion');
        }
        
        
        
    });
};

var arr = Array.from(test);
console.log(arr[0].id);

 console.log(test);
 console.log(test.namedItem(5));
console.log(test.namedItem(5).id);

var arr = Array.from(test);
let lion = (arr[0].id);
let zebre = (arr[1].id);
console.log(lion);

arr[0].addEventListener("click", function(){
    
        console.log('Coucou le lion');
    
})

********************

 let test = document.getElementsByClassName("stats");
var arr = Array.from(test);
let lion = (arr[0].id);
let zebre = (arr[1].id);
console.log(lion);

for (var i = 0 ; i < arr.length; i++) {
    arr[i].addEventListener("click", function() {
        let animal = arr.values();
        for (let element of animal) {
            console.log(element.id);
             if (element.id === "1")
                console.log('coucou lion');
        }
        }
        
    )}


    **************

    console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

 let test = document.getElementsByClassName("stats");
var arr = Array.from(test);
let lion = (arr[0].id);
let zebre = (arr[1].id);
console.log(lion);

for (var i = 0 ; i < arr.length; i++) {
    arr[i].addEventListener("click", function() {
        console.log((arr[i]).id);
        }
        
    )}

    //******* simplifi" : a partir html coll
    
    let test = document.getElementsByClassName("stats");

for (var i = 0 ; i < test.length; i++) {
    test[i].addEventListener("click", function() {
        console.log(test);
        for (let animal of test) {
            console.log(animal);
            if (animal.id === '1') {
                console.log('lion');
                break;
            } else if (animal.id === '5') {
                console.log('zebre');
                break;
            }
            
        }
        
        }
        
    )}


import {Api} from "./Api.js";

export class Orders {

    constructor() {   
        this.api = new Api; 
    }
    savePosition(key,value){
        localStorage.setItem(key,value);
    }

    getQtyOfMeal(i){
        const qty = document.getElementById(i+1).innerText;
        return qty;

    }

    getPriceOfMeal(i){
        const price = document.getElementById(`price${i+1}`).innerText;
        return price;

    }

    getSizeOfMeal(i){
        if(document.getElementById(`inlineRadio1-${i+1}`).checked) {
            return 'small';
          }else if(document.getElementById(`inlineRadio2-${i+1}`).checked) {
            return 'medium';
          }else if (document.getElementById(`inlineRadio3-${i+1}`).checked){
            return 'large';
          }
    }
    
    getMealTitle(i){
        const title = document.getElementById(`title-${i+1}`);
        return title.innerText;
    }
    saveMealData(i){
        this.savePosition(`mealName${i}`,this.getMealTitle(i));
        this.savePosition(`qty${i}`,this.getQtyOfMeal(i));
        this.savePosition(`size${i}`,this.getSizeOfMeal(i));
        this.savePosition(`price${i}`,this.getPriceOfMeal(i));
    }

    addMealToLocalStorageHandler(i){
        if(this.getQtyOfMeal(i)>0){
            this.saveMealData(i)
        }
    }

    saveMealsData(){
        const pricesFields = document.querySelectorAll('[id^="price"]');
        pricesFields.forEach((element,i) => {
            this.addMealToLocalStorageHandler(i);
        });
        window.location.href = '/order'
    }

    getQtyOfMealOnOrder(i){
        const qty = localStorage.getItem(`qty${i}`);
        return qty;
    }
    getSizeOfMealOnOrder(i){
        const size = localStorage.getItem(`size${i}`);
        return size;
    }
    getMealNameOnOrder(i){
        const mealName = localStorage.getItem(`mealName${i}`);
        return mealName;
    }

    getMealPriceOnOrder(i){
        const price = localStorage.getItem(`price${i}`);
        return price;
    }

    getElementsWithSpecificKeyFromLocalStorage(key){
        const arr = [];
        Object.entries(localStorage).map(
            x => x[0]
        ).filter(
            x => x.substring(0,3)==`${key}`
        ).map(
            x => arr.push(x));
            return arr;
    }

    createEmptyTableRow(i){
        const tbody = document.getElementById('tbody');
        const row = tbody.insertRow();
        row.setAttribute(`id`,`row${i}`);
    }
    createCell(i,value){
        const row = document.getElementById(`row${i}`);
        const cell = row.insertCell();
        cell.classList.add('text-center');
        cell.appendChild(value);
    }

    createTableRow(i){
        this.createEmptyTableRow(i);
        this.createCell(i,document.createTextNode(i+1));
        this.createCell(i,document.createTextNode(this.getMealNameOnOrder(i)));
        this.createCell(i,document.createTextNode(this.getSizeOfMealOnOrder(i)));
        this.createCell(i,document.createTextNode(this.getQtyOfMealOnOrder(i)));
        this.createCell(i,document.createTextNode(this.getMealPriceOnOrder(i)));

    }

    generateOrderData(){
        const arr = this.getElementsWithSpecificKeyFromLocalStorage('qty');
        arr.forEach((el,i)=>{
            this.createTableRow(i);
        })
        this.createPriceRow();
    }

    createPriceRow(){
        const tbody = document.getElementById('tbody');
        const row = tbody.insertRow();
        const cell = row.insertCell();
        cell.classList.add('text-center');
        cell.appendChild(document.createTextNode('Total:'));
        row.insertCell();
        row.insertCell();
        row.insertCell();
        const priceCell = row.insertCell();
        priceCell.classList.add('text-center');
        priceCell.appendChild(document.createTextNode(this.countTotalPrice()));
    }


    countTotalPrice(){
        const arr = this.getElementsWithSpecificKeyFromLocalStorage('qty');
        const totalPriceArr = [];
        arr.forEach((el,i)=>{
            const partSum = this.getMealPriceOnOrder(i) * this.getQtyOfMealOnOrder(i);
            totalPriceArr.push(partSum);
        })
        const totalPrice = totalPriceArr.reduce((partialSum, a) => partialSum + a, 0);
        return totalPrice;
    }

    placeOrderBtnAddEventListener(){
        const btn = document.getElementById('placeOrder');
    }
}
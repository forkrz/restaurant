import {Api} from "./Api.js";
export class MainPage{
    
    constructor() {   
        this.api = new Api;
      }

    minusAddEventListener(element,input){     
        element.addEventListener('click', ()=>{
            let inputValue = input.innerText;      
            if(inputValue >0){ 
                inputValue --;
                input.innerText = inputValue;
            }
        })
    }

    plusAddeventListener(element,input){
        element.addEventListener('click', ()=>{     
            let inputValue = input.innerText;   
            inputValue ++;
            input.innerText = inputValue;
        })       
    }

    qtyEventHandlers(minusIcon,plusIcon,input){
        this.minusAddEventListener(minusIcon,input);
        this.plusAddeventListener(plusIcon,input);
    }

    qty() {
        const inputs = document.querySelectorAll('.form-rounded');
        inputs.forEach((input,i) => {  
            this.qtyEventHandlers(document.querySelector(`[data-field-id='${i+1}'][data-button-type='minus']`),
            document.querySelector(`[data-field-id='${i+1}'][data-button-type='plus']`),
            input);
        });
         
    }

    mealPriceAddEventLisener = (element,price,priceField) =>{
        element.addEventListener('click', ()=>{
            priceField.innerText = price;
        })
    }

    priceHandler = (smallRadiobtn,smallPrice,mediumRadiobtn,mediumPrice,largeRadiobtn,largePrice,priceField) => {
        this.mealPriceAddEventLisener(smallRadiobtn,smallPrice,priceField);
        this.mealPriceAddEventLisener(mediumRadiobtn,mediumPrice,priceField);
        this.mealPriceAddEventLisener(largeRadiobtn,largePrice,priceField);
    }

    prices = async()=>{
        const data = await this.api.getMealData();
        const pricesFields = document.querySelectorAll('[id^="price"]');
        console.log(data);
        pricesFields.forEach((priceField,i) =>{
            this.priceHandler(document.querySelector(`[data-field-id='${i+1}'][data-button-type='small']`),data[i].small_price,
            document.querySelector(`[data-field-id='${i+1}'][data-button-type='medium']`),data[i].medium_price,
            document.querySelector(`[data-field-id='${i+1}'][data-button-type='large']`),data[i].large_price,
            priceField
            );
        });
    }
    

}
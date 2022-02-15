export class Quantites{
    

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

}
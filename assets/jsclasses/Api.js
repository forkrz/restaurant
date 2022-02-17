export class Api {

    getMealData = async() =>{

        const res =  await fetch('http://restaurant.loc/api/get_meals',{method: 'GET'});
        const json = await res.json();
        return json;
    }

    sendOrderData = async() =>{
        const data = await fetch('tba', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({a: 1, b: 'Textual content'})
        });
    }

} 
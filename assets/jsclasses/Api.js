export class Api {

    getMealData = async() =>{

        const res =  await fetch('http://restaurant.loc/api/get_meals');
        const json = await res.json();
        return json;

    }

} 
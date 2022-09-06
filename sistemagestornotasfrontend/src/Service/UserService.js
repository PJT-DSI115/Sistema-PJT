import {ENDPOINT} from "Config/EndPoint";


function getAllUsersByStudents({jwt, option}) {
    return (
        fetch(`${ENDPOINT}/getAllUsers/${option}`,{ 
            method: 'GET',
            headers : {
                'Authorization': jwt ? `Bearer ${jwt}`: '' 
            }
        }).then (response => {
            return response;
        })
    );
}

const getAgeByDateOfBirth = (age) => {
    let ageArray = age.split('-');
    let [year, month, day] = ageArray;
    let date = new Date();

    let ageSubtraction = date.getFullYear() - parseInt(year);

    if(date.getMonth() < month) {
        ageSubtraction = ageSubtraction -1;
    }
    if(date.getMonth() === parseInt(month)) {
        if(date.getDay() < parseInt(day)) {
            ageSubtraction = ageSubtraction - 1;
        }
    }
    return ageSubtraction;
}

export { getAllUsersByStudents, getAgeByDateOfBirth }

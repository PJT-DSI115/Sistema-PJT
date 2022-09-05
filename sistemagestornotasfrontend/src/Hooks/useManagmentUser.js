import Context from 'Context/UserContext';
import { useContext, useState, useEffect } from 'react';
import { getAllUsersByStudents } from 'Service/UserService';

function useManagmentUser() {

    const { jwt } = useContext(Context);
    const [users, setUsers] = useState([]);
    const [loading, setLoading] = useState(true);


    useEffect(() => {
        getAllUsersByStudents({jwt})
        .then(response => response.json())
            .then(data => {
                setUsers(data);
            })
    }, []);

    return {
        users
    }

}

export { useManagmentUser }

import { useEffect } from "react";
import { useUser } from "Hooks/useUser";
import { useNavigate } from "react-router-dom";
function Home() {
    const { isLogged, logout } = useUser();
    const navigate = useNavigate();


    const handleClick = (e) => {
        e.preventDefault();
        logout();

    }

    useEffect(() => {
        if(!isLogged) {
            navigate("/login");
        }
    }, [isLogged, navigate]);
    return(
        <div>
            <h1>Este es mi home</h1>
            <button onClick={handleClick}>CerrarSession</button>
        </div>
    ) 
}

export {Home};
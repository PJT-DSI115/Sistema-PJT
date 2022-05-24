import { useEffect } from "react";
import { useUser } from "Hooks/useUser";
import { useNavigate } from "react-router-dom";
function Home() {
    const { isLogged } = useUser();
    const navigate = useNavigate();

    useEffect(() => {
        if(!isLogged) {
            navigate("/login");
        }
    }, [isLogged, navigate]);
    return(
        <div>
            <h1>Este es mi home</h1>
        </div>
    ) 
}

export {Home};
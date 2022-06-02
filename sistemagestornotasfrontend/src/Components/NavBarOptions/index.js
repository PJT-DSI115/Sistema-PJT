import React from "react";
import './index.css';
import { ListOptions } from "./ListOptions";

function NavBarOptions(){
    return(
        <nav className="NavBar-right">
            <ul className="NavBar-list">
                <ListOptions />
            </ul>
        </nav>
    );
}

export { NavBarOptions };
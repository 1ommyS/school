import "./globals";
import * as React from "react";
import * as ReactDOM from "react-dom";
import {Page} from "./components/Page";
import Premiums from "./components/Premiums/Premiums";
import {BrowserRouter, Route, Switch} from "react-router-dom";
import Edit from "components/Edit/edit";
import Payments from "./components/Payments/Payments";


// @ts-ignore
ReactDOM.render(
    <BrowserRouter>
        <Switch>
            <Route path="/panel" exact>
                <Page />
            </Route>
            <Route path="/panel/edit/:id">
                <Edit />
            </Route>
            <Route path="/panel/premiums" exact>
                <Premiums />
            </Route>
            <Route path="/panel/payments" exact>
                <Payments />
            </Route>

        </Switch>
    </BrowserRouter>,
    document.querySelector("#app")
);

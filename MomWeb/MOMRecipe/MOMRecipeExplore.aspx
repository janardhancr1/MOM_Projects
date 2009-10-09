<%@ Page Language="C#" MasterPageFile="~/MOMMaster/MOMTransAd.master" AutoEventWireup="true" CodeFile="MOMRecipeExplore.aspx.cs" Inherits="MOMRecipe_MOMRecipeExplore" %>

<asp:Content ID="Content1" ContentPlaceHolderID="momLeft" runat="server">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="95%" cellpadding="3">
                    <tr>
                        <td style="background-color: MistyRose;">
                            <a href="MOMRecipesHome.aspx">Home</a>
                        </td>
                        <td style="background-color: MistyRose;">
                            <a href="MOMRecipeSearch.aspx">Search</a>
                        </td>
                        <td style="background-color: MistyRose;">
                            <a href="MOMRecipeExplore.aspx">Explore Tags</a>
                        </td>
                        <td style="background-color: MistyRose;">
                            <a href="MOMRecipeRecent.aspx">Most Recent</a>
                        </td>
                        <td style="background-color: MistyRose;">
                            <a href="MOMRecipeTopRated.aspx">Top Rated</a>
                        </td>
                        <td style="background-color: MistyRose;">
                            <a href="MOMRecipeAdd.aspx">Add a Recipe</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" height="200">
            <tr>
                <td align="center">
                    <!--<a href="MOMRecipeSearch.aspx?mQs=appetizer">appetizer</a> <a href="MOMRecipeSearch.aspx?mQs=appetizers">appetizers</a> <a href="MOMRecipeSearch.aspx?mQs=apple">apple</a> <a href="MOMRecipeSearch.aspx?mQs=asian">asian</a> <a href="MOMRecipeSearch.aspx?mQs=bacon">bacon</a> <a href="MOMRecipeSearch.aspx?mQs=baked">baked</a> <a href="MOMRecipeSearch.aspx?mQs=banana">banana</a> <a href="MOMRecipeSearch.aspx?mQs=bbq">bbq</a> <a href="MOMRecipeSearch.aspx?mQs=beans">beans</a> <a href="MOMRecipeSearch.aspx?mQs=beef">beef</a> <a href="MOMRecipeSearch.aspx?mQs=beverage">beverage</a> <a href="MOMRecipeSearch.aspx?mQs=bread">bread</a> <a href="MOMRecipeSearch.aspx?mQs=breakfast">breakfast</a> <a href="MOMRecipeSearch.aspx?mQs=broccoli">broccoli</a> <a href="MOMRecipeSearch.aspx?mQs=brunch">brunch</a> <a href="MOMRecipeSearch.aspx?mQs=butter">butter</a> <a href="MOMRecipeSearch.aspx?mQs=cake">cake</a> <a href="MOMRecipeSearch.aspx?mQs=cakes">cakes</a> <a href="MOMRecipeSearch.aspx?mQs=casserole">casserole</a> <a href="MOMRecipeSearch.aspx?mQs=cheese">cheese</a> <a href="MOMRecipeSearch.aspx?mQs=cheesecake">cheesecake</a> <a href="MOMRecipeSearch.aspx?mQs=chicken">chicken</a> <a href="MOMRecipeSearch.aspx?mQs=chili">chili</a> <a href="MOMRecipeSearch.aspx?mQs=chinese">chinese</a> <a href="MOMRecipeSearch.aspx?mQs=chocolate">chocolate</a> <a href="MOMRecipeSearch.aspx?mQs=christmas">christmas</a> <a href="MOMRecipeSearch.aspx?mQs=coconut">coconut</a> <a href="MOMRecipeSearch.aspx?mQs=cookie">cookie</a> <a href="MOMRecipeSearch.aspx?mQs=cookies">cookies</a> <a href="MOMRecipeSearch.aspx?mQs=corn">corn</a> <a href="MOMRecipeSearch.aspx?mQs=course">course</a> <a href="MOMRecipeSearch.aspx?mQs=cream">cream</a> <a href="MOMRecipeSearch.aspx?mQs=crockpot">crockpot</a> <a href="MOMRecipeSearch.aspx?mQs=curry">curry</a> <a href="MOMRecipeSearch.aspx?mQs=desert">desert</a> <a href="MOMRecipeSearch.aspx?mQs=dessert">dessert</a> <a href="MOMRecipeSearch.aspx?mQs=desserts">desserts</a> <a href="MOMRecipeSearch.aspx?mQs=dinner">dinner</a> <a href="MOMRecipeSearch.aspx?mQs=dip">dip</a> <a href="MOMRecipeSearch.aspx?mQs=dish">dish</a> <a href="MOMRecipeSearch.aspx?mQs=dressing">dressing</a> <a href="MOMRecipeSearch.aspx?mQs=drink">drink</a> <a href="MOMRecipeSearch.aspx?mQs=drinks">drinks</a> <a href="MOMRecipeSearch.aspx?mQs=easy">easy</a> <a href="MOMRecipeSearch.aspx?mQs=egg">egg</a> <a href="MOMRecipeSearch.aspx?mQs=eggs">eggs</a> <a href="MOMRecipeSearch.aspx?mQs=entree">entree</a> <a href="MOMRecipeSearch.aspx?mQs=fish">fish</a> <a href="MOMRecipeSearch.aspx?mQs=food">food</a> <a href="MOMRecipeSearch.aspx?mQs=fruit">fruit</a> <a href="MOMRecipeSearch.aspx?mQs=garlic">garlic</a> <a href="MOMRecipeSearch.aspx?mQs=healthy">healthy</a> <a href="MOMRecipeSearch.aspx?mQs=holiday">holiday</a> <a href="MOMRecipeSearch.aspx?mQs=indian">indian</a> <a href="MOMRecipeSearch.aspx?mQs=italian">italian</a> <a href="MOMRecipeSearch.aspx?mQs=lemon">lemon</a> <a href="MOMRecipeSearch.aspx?mQs=lunch">lunch</a> <a href="MOMRecipeSearch.aspx?mQs=main">main</a> <a href="MOMRecipeSearch.aspx?mQs=meat">meat</a> <a href="MOMRecipeSearch.aspx?mQs=mexican">mexican</a> <a href="MOMRecipeSearch.aspx?mQs=mushroom">mushroom</a> <a href="MOMRecipeSearch.aspx?mQs=onion">onion</a> <a href="MOMRecipeSearch.aspx?mQs=party">party</a> <a href="MOMRecipeSearch.aspx?mQs=pasta">pasta</a> <a href="MOMRecipeSearch.aspx?mQs=peanut">peanut</a> <a href="MOMRecipeSearch.aspx?mQs=pie">pie</a> <a href="MOMRecipeSearch.aspx?mQs=pizza">pizza</a> <a href="MOMRecipeSearch.aspx?mQs=pork">pork</a> <a href="MOMRecipeSearch.aspx?mQs=potato">potato</a> <a href="MOMRecipeSearch.aspx?mQs=potatoes">potatoes</a> <a href="MOMRecipeSearch.aspx?mQs=pudding">pudding</a> <a href="MOMRecipeSearch.aspx?mQs=pumpkin">pumpkin</a> <a href="MOMRecipeSearch.aspx?mQs=quick">quick</a> <a href="MOMRecipeSearch.aspx?mQs=rice">rice</a> <a href="MOMRecipeSearch.aspx?mQs=salad">salad</a> <a href="MOMRecipeSearch.aspx?mQs=sandwich">sandwich</a> <a href="MOMRecipeSearch.aspx?mQs=sauce">sauce</a> <a href="MOMRecipeSearch.aspx?mQs=sausage">sausage</a> <a href="MOMRecipeSearch.aspx?mQs=seafood">seafood</a> <a href="MOMRecipeSearch.aspx?mQs=shrimp">shrimp</a> <a href="MOMRecipeSearch.aspx?mQs=side">side</a> <a href="MOMRecipeSearch.aspx?mQs=sides">sides</a> <a href="MOMRecipeSearch.aspx?mQs=snack">snack</a> <a href="MOMRecipeSearch.aspx?mQs=soup">soup</a> <a href="MOMRecipeSearch.aspx?mQs=spicy">spicy</a> <a href="MOMRecipeSearch.aspx?mQs=spinach">spinach</a> <a href="MOMRecipeSearch.aspx?mQs=starter">starter</a> <a href="MOMRecipeSearch.aspx?mQs=steak">steak</a> <a href="MOMRecipeSearch.aspx?mQs=stew">stew</a> <a href="MOMRecipeSearch.aspx?mQs=sweet">sweet</a> <a href="MOMRecipeSearch.aspx?mQs=thai">thai</a> <a href="MOMRecipeSearch.aspx?mQs=thanksgiving">thanksgiving</a> <a href="MOMRecipeSearch.aspx?mQs=tomato">tomato</a> <a href="MOMRecipeSearch.aspx?mQs=turkey">turkey</a> <a href="MOMRecipeSearch.aspx?mQs=vegan">vegan</a> <a href="MOMRecipeSearch.aspx?mQs=vegetable">vegetable</a> <a href="MOMRecipeSearch.aspx?mQs=vegetables">vegetables</a> <a href="MOMRecipeSearch.aspx?mQs=vegetarian">vegetarian</a> <a href="MOMRecipeSearch.aspx?mQs=watchers">watchers</a> <a href="MOMRecipeSearch.aspx?mQs=weight">weight</a>-->
                    <a href="MOMRecipeSearch.aspx?mQs=appetizer" style="font-size: 188%">appetizer</a> 
<a href="MOMRecipeSearch.aspx?mQs=appetizers" style="font-size: 151%">appetizers</a> 
<a href="MOMRecipeSearch.aspx?mQs=apple" style="font-size: 185%">apple</a> 
<a href="MOMRecipeSearch.aspx?mQs=asian" style="font-size: 166%">asian</a> 
<a href="MOMRecipeSearch.aspx?mQs=bacon" style="font-size: 147%">bacon</a> 
<a href="MOMRecipeSearch.aspx?mQs=baked" style="font-size: 184%">baked</a> 
<a href="MOMRecipeSearch.aspx?mQs=banana" style="font-size: 159%">banana</a> 
<a href="MOMRecipeSearch.aspx?mQs=bbq" style="font-size: 144%">bbq</a> 
<a href="MOMRecipeSearch.aspx?mQs=beans" style="font-size: 165%">beans</a> 
<a href="MOMRecipeSearch.aspx?mQs=beef" style="font-size: 105%">beef</a> 
<a href="MOMRecipeSearch.aspx?mQs=beverage" style="font-size: 196%">beverage</a> 
<a href="MOMRecipeSearch.aspx?mQs=bread" style="font-size: 149%">bread</a> 
<a href="MOMRecipeSearch.aspx?mQs=breakfast" style="font-size: 129%">breakfast</a> 
<a href="MOMRecipeSearch.aspx?mQs=broccoli" style="font-size: 100%">broccoli</a> 
<a href="MOMRecipeSearch.aspx?mQs=brunch" style="font-size: 200%">brunch</a> 
<a href="MOMRecipeSearch.aspx?mQs=butter" style="font-size: 167%">butter</a> 
<a href="MOMRecipeSearch.aspx?mQs=cake" style="font-size: 159%">cake</a> 
<a href="MOMRecipeSearch.aspx?mQs=cakes" style="font-size: 141%">cakes</a> 
<a href="MOMRecipeSearch.aspx?mQs=casserole" style="font-size: 164%">casserole</a> 
<a href="MOMRecipeSearch.aspx?mQs=cheese" style="font-size: 125%">cheese</a> 
<a href="MOMRecipeSearch.aspx?mQs=cheesecake" style="font-size: 131%">cheesecake</a> 
<a href="MOMRecipeSearch.aspx?mQs=chicken" style="font-size: 112%">chicken</a> 
<a href="MOMRecipeSearch.aspx?mQs=chili" style="font-size: 192%">chili</a> 
<a href="MOMRecipeSearch.aspx?mQs=chinese" style="font-size: 127%">chinese</a> 
<a href="MOMRecipeSearch.aspx?mQs=chocolate" style="font-size: 142%">chocolate</a> 
<a href="MOMRecipeSearch.aspx?mQs=christmas" style="font-size: 155%">christmas</a> 
<a href="MOMRecipeSearch.aspx?mQs=coconut" style="font-size: 155%">coconut</a> 
<a href="MOMRecipeSearch.aspx?mQs=cookie" style="font-size: 195%">cookie</a> 
<a href="MOMRecipeSearch.aspx?mQs=cookies" style="font-size: 124%">cookies</a> 
<a href="MOMRecipeSearch.aspx?mQs=corn" style="font-size: 161%">corn</a> 
<a href="MOMRecipeSearch.aspx?mQs=course" style="font-size: 154%">course</a> 
<a href="MOMRecipeSearch.aspx?mQs=cream" style="font-size: 107%">cream</a> 
<a href="MOMRecipeSearch.aspx?mQs=crockpot" style="font-size: 184%">crockpot</a> 
<a href="MOMRecipeSearch.aspx?mQs=curry" style="font-size: 163%">curry</a> 
<a href="MOMRecipeSearch.aspx?mQs=desert" style="font-size: 163%">desert</a> 
<a href="MOMRecipeSearch.aspx?mQs=dessert" style="font-size: 100%">dessert</a> 
<a href="MOMRecipeSearch.aspx?mQs=desserts" style="font-size: 165%">desserts</a> 
<a href="MOMRecipeSearch.aspx?mQs=dinner" style="font-size: 160%">dinner</a> 
<a href="MOMRecipeSearch.aspx?mQs=dip" style="font-size: 107%">dip</a> 
<a href="MOMRecipeSearch.aspx?mQs=dish" style="font-size: 153%">dish</a> 
<a href="MOMRecipeSearch.aspx?mQs=dressing" style="font-size: 146%">dressing</a> 
<a href="MOMRecipeSearch.aspx?mQs=drink" style="font-size: 183%">drink</a> 
<a href="MOMRecipeSearch.aspx?mQs=drinks" style="font-size: 108%">drinks</a> 
<a href="MOMRecipeSearch.aspx?mQs=easy" style="font-size: 139%">easy</a> 
<a href="MOMRecipeSearch.aspx?mQs=egg" style="font-size: 177%">egg</a> 
<a href="MOMRecipeSearch.aspx?mQs=eggs" style="font-size: 128%">eggs</a> 
<a href="MOMRecipeSearch.aspx?mQs=entree" style="font-size: 177%">entree</a> 
<a href="MOMRecipeSearch.aspx?mQs=fish" style="font-size: 165%">fish</a> 
<a href="MOMRecipeSearch.aspx?mQs=food" style="font-size: 145%">food</a> 
<a href="MOMRecipeSearch.aspx?mQs=fruit" style="font-size: 188%">fruit</a> 
<a href="MOMRecipeSearch.aspx?mQs=garlic" style="font-size: 180%">garlic</a> 
<a href="MOMRecipeSearch.aspx?mQs=healthy" style="font-size: 104%">healthy</a> 
<a href="MOMRecipeSearch.aspx?mQs=holiday" style="font-size: 107%">holiday</a> 
<a href="MOMRecipeSearch.aspx?mQs=indian" style="font-size: 191%">indian</a> 
<a href="MOMRecipeSearch.aspx?mQs=italian" style="font-size: 140%">italian</a> 
<a href="MOMRecipeSearch.aspx?mQs=lemon" style="font-size: 150%">lemon</a> 
<a href="MOMRecipeSearch.aspx?mQs=lunch" style="font-size: 193%">lunch</a> 
<a href="MOMRecipeSearch.aspx?mQs=main" style="font-size: 187%">main</a> 
<a href="MOMRecipeSearch.aspx?mQs=meat" style="font-size: 107%">meat</a> 
<a href="MOMRecipeSearch.aspx?mQs=mexican" style="font-size: 133%">mexican</a> 
<a href="MOMRecipeSearch.aspx?mQs=mushroom" style="font-size: 160%">mushroom</a> 
<a href="MOMRecipeSearch.aspx?mQs=onion" style="font-size: 154%">onion</a> 
<a href="MOMRecipeSearch.aspx?mQs=party" style="font-size: 120%">party</a> 
<a href="MOMRecipeSearch.aspx?mQs=pasta" style="font-size: 147%">pasta</a> 
<a href="MOMRecipeSearch.aspx?mQs=peanut" style="font-size: 192%">peanut</a> 
<a href="MOMRecipeSearch.aspx?mQs=pie" style="font-size: 117%">pie</a> 
<a href="MOMRecipeSearch.aspx?mQs=pizza" style="font-size: 183%">pizza</a> 
<a href="MOMRecipeSearch.aspx?mQs=pork" style="font-size: 145%">pork</a> 
<a href="MOMRecipeSearch.aspx?mQs=potato" style="font-size: 135%">potato</a> 
<a href="MOMRecipeSearch.aspx?mQs=potatoes" style="font-size: 186%">potatoes</a> 
<a href="MOMRecipeSearch.aspx?mQs=pudding" style="font-size: 174%">pudding</a> 
<a href="MOMRecipeSearch.aspx?mQs=pumpkin" style="font-size: 124%">pumpkin</a> 
<a href="MOMRecipeSearch.aspx?mQs=quick" style="font-size: 170%">quick</a> 
<a href="MOMRecipeSearch.aspx?mQs=rice" style="font-size: 120%">rice</a> 
<a href="MOMRecipeSearch.aspx?mQs=salad" style="font-size: 165%">salad</a> 
<a href="MOMRecipeSearch.aspx?mQs=sandwich" style="font-size: 123%">sandwich</a> 
<a href="MOMRecipeSearch.aspx?mQs=sauce" style="font-size: 134%">sauce</a> 
<a href="MOMRecipeSearch.aspx?mQs=sausage" style="font-size: 168%">sausage</a> 
<a href="MOMRecipeSearch.aspx?mQs=seafood" style="font-size: 181%">seafood</a> 
<a href="MOMRecipeSearch.aspx?mQs=shrimp" style="font-size: 122%">shrimp</a> 
<a href="MOMRecipeSearch.aspx?mQs=side" style="font-size: 108%">side</a> 
<a href="MOMRecipeSearch.aspx?mQs=sides" style="font-size: 128%">sides</a> 
<a href="MOMRecipeSearch.aspx?mQs=snack" style="font-size: 152%">snack</a> 
<a href="MOMRecipeSearch.aspx?mQs=soup" style="font-size: 143%">soup</a> 
<a href="MOMRecipeSearch.aspx?mQs=spicy" style="font-size: 161%">spicy</a> 
<a href="MOMRecipeSearch.aspx?mQs=spinach" style="font-size: 155%">spinach</a> 
<a href="MOMRecipeSearch.aspx?mQs=starter" style="font-size: 134%">starter</a> 
<a href="MOMRecipeSearch.aspx?mQs=steak" style="font-size: 149%">steak</a> 
<a href="MOMRecipeSearch.aspx?mQs=stew" style="font-size: 130%">stew</a> 
<a href="MOMRecipeSearch.aspx?mQs=sweet" style="font-size: 152%">sweet</a> 
<a href="MOMRecipeSearch.aspx?mQs=thai" style="font-size: 181%">thai</a> 
<a href="MOMRecipeSearch.aspx?mQs=thanksgiving" style="font-size: 108%">thanksgiving</a> 
<a href="MOMRecipeSearch.aspx?mQs=tomato" style="font-size: 151%">tomato</a> 
<a href="MOMRecipeSearch.aspx?mQs=turkey" style="font-size: 108%">turkey</a> 
<a href="MOMRecipeSearch.aspx?mQs=vegan" style="font-size: 183%">vegan</a> 
<a href="MOMRecipeSearch.aspx?mQs=vegetable" style="font-size: 144%">vegetable</a> 
<a href="MOMRecipeSearch.aspx?mQs=vegetables" style="font-size: 161%">vegetables</a> 
<a href="MOMRecipeSearch.aspx?mQs=vegetarian" style="font-size: 123%">vegetarian</a> 
<a href="MOMRecipeSearch.aspx?mQs=watchers" style="font-size: 187%">watchers</a> 
<a href="MOMRecipeSearch.aspx?mQs=weight" style="font-size: 162%">weight</a>


                </td>
            </tr>
            </table>
            </td>
        </tr>
    </table>
</asp:Content>

<asp:Content ID="Content3" ContentPlaceHolderID="momRight" runat="server">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td>
            </td>
        </tr>
    </table>
</asp:Content>
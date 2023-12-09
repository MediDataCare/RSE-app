<table>
    <thead>
    <tr>
        <th colspan="{{ $totalColumns }}" style="border: 1px solid black;">{{ data_get($study, 'title') }}</th>
    </tr>
    <tr>
        <th colspan="{{ $totalColumns }}" style="font-size: 13px;">{{ data_get($study, 'description') }}</th>
    </tr> 
    <tr></tr>          
    <tr>
        <!-- 
            - Como adicionar informação proveniente de outras tabelas? Idade, etc.
            -  
        -->
        <th>Idade</th>
        <th>Sexo</th>
        <th>Distrito</th>
        <th>DIABETES</th>
        <th>Tipo de Diabetes</th>
        <th>FUMADOR</th>
        <th>Fumador</th>
        <th>Fumador(Obs.)</th>
    </tr>
    </thead>
    <tbody>
        <!-- 
            - Adicionar FOR para criar linhas Consoante o nº de dados partilhados
            - Como adicionar informação proveniente de outras tabelas? Idade, etc.
            -  
        -->
        <tr>
            <td>71</td>
            <td>Female</td>
            <td>Faro</td>
            <td></td>
            <td>Gestational Diabetes</td>
            <td></td>
            <td>Sim</td>
            <td>Sim</td>
        </tr>
        <tr>
            <td>64</td>
            <td>Male</td>
            <td>Lisbon</td>
            <td></td>
            <td>Type 1 Diabetes</td>
            <td></td>
            <td>Não</td>
            <td>Não</td>
        </tr>
        <tr>
            <td>82</td>
            <td>Female</td>
            <td>Viseu</td>
            <td></td>
            <td>Type 2 Diabetes</td>
            <td></td>
            <td>Sim</td>
            <td>Ocasionalmente</td>
        </tr>
        <tr>
            <td>24</td>
            <td>Male</td>
            <td>Lisbon</td>
            <td></td>
            <td>Type 1 Diabetes</td>
            <td></td>
            <td>Sim</td>
            <td>Sim</td>
        </tr>
        <tr>
            <td>42</td>
            <td>Male</td>
            <td>Faro</td>
            <td></td>
            <td>Gestational Diabetes</td>
            <td></td>
            <td>Sim</td>
            <td>Ex-Fumador</td>
        </tr>
    </tbody>
</table>

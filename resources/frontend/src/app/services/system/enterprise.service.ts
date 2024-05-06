import {Injectable} from '@angular/core';
import {HttpReprint} from "../../utils/http-reprint";
import {SystemAgreement, SystemEnterprise} from "../../models/system";
import {Paginate} from "../../models/server-response";
import {ENTERPRISE_DELETE, ENTERPRISE_ITEMS, ENTERPRISE_SAVE, ENTERPRISE_VIEW} from "../../api/system.api";


@Injectable({
  providedIn: 'root'
})
export class EnterpriseService {

  constructor(private http: HttpReprint) {
  }

  public items(page: number = 1, query?: SystemEnterprise) {
    return this.http.post<Paginate<SystemEnterprise>>(`${ENTERPRISE_ITEMS}?page=${page}`, query)
  }

  public save(postData: SystemEnterprise) {
    return this.http.post(ENTERPRISE_SAVE, postData)
  }

  public view(id: string) {
    return this.http.post<SystemAgreement>(ENTERPRISE_VIEW, {id})
  }

  public delete(id: string | undefined) {
    return this.http.post(ENTERPRISE_DELETE, {id})
  }
}

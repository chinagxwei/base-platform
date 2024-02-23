import {Injectable} from '@angular/core';
import {HttpReprint} from "../../utils/http-reprint";
import {Paginate} from "../../models/server-response";
import {Navigation} from "../../models/system";
import {
  NAVIGATION_ALL_ITEMS,
  NAVIGATION_DELETE,
  NAVIGATION_ITEMS,
  NAVIGATION_SAVE,
  NAVIGATION_SORT
} from "../../api/system.api";

@Injectable({
  providedIn: 'root'
})
export class NavigationService {

  constructor(private http: HttpReprint) {
  }

  public items(page: number = 1, query?: Navigation) {
    return this.http.post<Paginate<Navigation>>(`${NAVIGATION_ITEMS}?page=${page}`, query);
  }

  public save(navigation: Navigation) {
    return this.http.post(NAVIGATION_SAVE, navigation);
  }

  public delete(id: number | undefined) {
    return this.http.post(NAVIGATION_DELETE, {id});
  }

  public sort(sortItems: { id: number, sort: number }[]) {
    return this.http.post(NAVIGATION_SORT, sortItems);
  }

  public all() {
    return this.http.post<Navigation[]>(NAVIGATION_ALL_ITEMS);
  }
}
